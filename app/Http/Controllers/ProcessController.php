<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Models\Alternative;
use DB;

class ProcessController extends Controller
{
    function results($ranked)
    {
        $ids = implode(',', $ranked);
        $results = Alternative::whereIntegerInRaw('id', $ranked)
            ->orderByRaw(Alternative::raw("FIELD(id, $ids)"))
            ->get(['id', 'nama_mahasiswa', 'grade','major','gpa','skkm','parentsalary']);
        $alter = Alternative::get(['id', 'nama_mahasiswa', 'grade','major','gpa','skkm','parentsalary']);
        $criteria = Criteria::all();
        return view('RankingResults', compact('results'));
    }

    public function process(Request $request)
    {
        if ($request->has('alternative')) {
                $criteria = Criteria::all();
                // start working on Multi-Objective Optimization Method by Ratio Analysis method
                $alter = $request->alternative;
                $weights = array();
                foreach ($criteria as $criterion) {
                    $weights[$criterion->criteria_name] = $request->{'weight' . $criterion->id};
                }
                // Normalize
                $normalized = $this->normalize($criteria, $alter);
                // Normalized * weights
                $weighted = $this->weighted($criteria, $alter, $normalized, $weights);
                // Sum of weighted and get final result
                $finalResult = $this->minMax($criteria, $alter, $weighted);
                // Send to results
                $ranked = array_keys($finalResult);

                return $this->results($ranked);
            }
        }
    }

    function normalize($criteria, $gpa, $skkm, $parentsalary)
    {
        $scores = array();
        foreach ($criteria as $criterion) {
            foreach ($gpa as $gpa) {
                $a = Alternative::where('id', $gpa)->first();
                $value = pow($a->{$criterion->criteria_name}, 2);
                $scores[$gpa][$criterion->criteria_name] = $value;
            }
            foreach ($skkm as $skkm) {
                $a = Alternative::where('id', $skkm)->first();
                $value = pow($a->{$criterion->criteria_name}, 2);
                $scores[$skkm][$criterion->criteria_name] = $value;
            }
            foreach ($parentsalary as $parentsalary) {
                $a = Alternative::where('id', $parentsalary)->first();
                $value = pow($a->{$criterion->criteria_name}, 2);
                $scores[$parentsalary][$criterion->criteria_name] = $value;
            }
            $value = array_sum(array_column($scores, $criterion->criteria_name));
            $value = sqrt($value);
            foreach ($gpa as $gpa) {
                $a = Alternative::where('id', $gpa)->first();
                $scores[$gpa][$criterion->criteria_name] = $a->{$criterion->criteria_name} / $value;
            }
            foreach ($skkm as $skkm) {
                $a = Alternative::where('id', $gpa)->first();
                $scores[$skkm][$criterion->criteria_name] = $a->{$criterion->criteria_name} / $value;
            }
            foreach ($parentsalary as $parentsalary) {
                $a = Alternative::where('id', $gpa)->first();
                $scores[$parentsalary][$criterion->criteria_name] = $a->{$criterion->criteria_name} / $value;
            }
        }
        return $scores;
    }

    function weighted($criteria, $gpa, $skkm, $parentsalary, $normalized, $weights)
    {
        $scores = $normalized;
        foreach ($criteria as $criterion) {
            if($criterion->criteria_name == 'GPA'){
                foreach ($gpa as $gpa) {
                    $value = $scores[$gpa][$criterion->criteria_name] * $weights[$criterion->bobot];
                    $scores[$gpa][$criterion->criteria_name] = $value;
                }
            } else if ($criterion->criteria_name == 'SKKM')
                foreach ($skkm as $skkm) {
                $value = $scores[$gpa][$criterion->criteria_name] * $weights[$criterion->bobot];
                $scores[$skkm][$criterion->criteria_name] = $value;
            } else if ($criterion->criteria_name == 'Parent Salary')
                foreach ($parentsalary as $parentsalary) {
                $value = $scores[$parentsalary][$criterion->criteria_name] * $weights[$criterion->criteria_name];
                $scores[$parentsalary][$criterion->criteria_name] = $value;
            }
        }
        return $scores;
    }

    function minMax($criteria, $gpa, $skkm, $parentsalary, $weighted)
    {
        $scores = $weighted;
        $max = array();
        $min = array();
        foreach ($gpa as $gpa) {
            $valueMax = 0;
            $valueMin = 0;
            $valueMax +=  $scores[$gpa][$criteria->criteria_name];
            $max[$gpa] = $valueMax;
            $min[$gpa] = $valueMin;
        }
        foreach ($skkm as $skkm) {
            $valueMax = 0;
            $valueMin = 0;
            $valueMax +=  $scores[$skkm][$criteria->criteria_name];
            $max[$skkm] = $valueMax;
            $min[$skkm] = $valueMin;
        }
        foreach ($parentsalary as $parentsalary) {
            $valueMin = 0;
            $valueMin +=  $scores[$parentsalary][$criteria->criteria_name];
            $max[$parentsalary] = $valueMax;
            $min[$parentsalary] = $valueMin;
        }
        return ranking($gpa, $skkm, $parentsalary, $max, $min);
    }
    
    function ranking($gpa, $skkm, $parentsalary, $max, $min)
    {
        $ranking = array();
        $value = ($max[$gpa]+$max[$skkm]) - $min[$parentsalary];
        $ranking[$gpa] = $value;
        return sort($ranking);
    }

    function sort($ranking)
    {
        arsort($ranking, SORT_NUMERIC);
        return $ranking;
    }

