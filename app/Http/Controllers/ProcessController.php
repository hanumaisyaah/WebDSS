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

    function normalize($criteria, $alter)
    {
        $scores = array();
        foreach ($criteria as $criterion) {
            foreach ($alter as $alternative) {
                $a = Alternative::where('id', $alternative)->first();
                $value = pow($a->{$criterion->criteria_name}, 2);
                $scores[$alter][$criterion->criteria_name] = $value;
            }
            $value = array_sum(array_column($scores, $criterion->criteria_name));
            $value = sqrt($value);
            foreach ($alter as $alternative) {
                $a = Alternative::where('id', $alternative)->first();
                $scores[$alternative][$criterion->criteria_name] = $a->{$criterion->criteria_name} / $value;
            }
        }
        return $scores;
    }

    function weighted($criteria, $alter, $normalized, $weights)
    {
        $scores = $normalized;
        foreach ($criteria as $criterion) {
            foreach ($alter as $alternative) {
                $value = $scores[$alternative][$criterion->criteria_name] * $weights[$criterion->criteria_name];
                $scores[$alternative][$criterion->criteria_name] = $value;
            }
        }
        return $scores;
    }
    function minMax($criteria, $alter, $weighted)
    {
        $scores = $weighted;
        $max = array();
        $min = array();
        foreach ($alter as $alternative) {
            $valueMax = 0;
            $valueMin = 0;
            foreach ($criteria as $criterion) {
                if ($criterion->criteria_type == 'benefit') {
                    $valueMax +=  $scores[$alternative][$criterion->criteria_name];
                } else if ($criterion->criteria_type == 'cost') {
                    $valueMin +=  $scores[$alternative][$criterion->criteria_name];
                }
            }
            $max[$alternative] = $valueMax;
            $min[$alternative] = $valueMin;
        }

        return ranking($alternative, $max, $min);
    }
    function ranking($alter, $max, $min)
    {
        $ranking = array();
        foreach ($alter as $alternative) {
            $value = $max[$alternative] - $min[$alternative];
            $ranking[$alternative] = $value;
        }
        return sort($ranking);
    }
    function sort($ranking)
    {
        arsort($ranking, SORT_NUMERIC);
        return $ranking;
    }

