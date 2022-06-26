<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
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
            ->get(['id', 'nama_mahasiswa', 'grade', 'major', 'gpa', 'skkm', 'parent_salary']);
        $alter = Alternative::get(['id', 'nama_mahasiswa', 'grade', 'major', 'gpa', 'skkm', 'parent_salary']);
        $criteria = Criteria::all();
        Session::flash('success', $results[0]->nama_mahasiswa . ' is the highest-ranking among all your choices');
        return view('admin.RankingResults', compact('alter', 'criteria', 'results'));
    }
    public function process()
    {
        $criteria = Criteria::all();
        // start working on Multi-Objective Optimization Method by Ratio Analysis method
        $alter = Alternative::pluck('id');
        // Normalize
        $normalized = $this->normalize($criteria, $alter);
        // Normalized * weights
        $weighted = $this->weighted($criteria, $alter, $normalized);
        // Sum of weighted and get final result
        $finalResult = $this->minMax($criteria, $alter, $weighted);
        // Send to results
        $ranked = array_keys($finalResult);
        return $this->results($ranked);
    }

    public function normalize($criteria, $alternative)
    {
        $scores = array();
        foreach ($criteria as $criterion) {
            foreach ($alternative as $alter) {
                $a = Alternative::where('id', $alter)->first();
                $value = pow($a->{$criterion->criteria_name}, 2);
                $scores[$alter][$criterion->criteria_name] = $value;
            }
            $value = array_sum(array_column($scores, $criterion->criteria_name));
            $value = sqrt($value);
            foreach ($alternative as $alter) {
                $a = Alternative::where('id', $alter)->first();
                $scores[$alter][$criterion->criteria_name] == 0 ? 0 : (($a->{$criterion->criteria_name}) / $value);
            }
        }
        return $scores;
    }
    public function weighted($criteria, $alternative, $normalized)
    {
        $scores = $normalized;
        foreach ($criteria as $criterion) {
            foreach ($alternative as $alter) {
                $value = $scores[$alter][$criterion->criteria_name] * $criterion->weight;
                $scores[$alter][$criterion->criteria_name] = $value;
            }
        }
        return $scores;
    }
    public function minMax($criteria, $alternative, $scores)
    {
        $results = array();
        foreach ($alternative as $alter) {
            $valueMax = 0;
            $valueMin = 0;
            foreach ($criteria as $criterion) {
                if ($criterion->attribute == 'benefit') {
                    $valueMax +=  $scores[$alter][$criterion->criteria_name];
                } else if ($criterion->attribute == 'cost') {
                    $valueMin +=  $scores[$alter][$criterion->criteria_name];
                }
            }
            $results[$alter]['max'] = $valueMax;
            $results[$alter]['min'] = $valueMin;
        }
        return $results;
    }
    public function ranking($alternative, $results)
    {
        $ranking = array();
        foreach ($alternative as $alter) {
            $value = $results[$alter]['max'] - $results[$alter]['min'];
            $ranking[$alter] = $value;
        }
        return $this->sort($ranking);

    }

    public function sort($ranking)
    {
        arsort($ranking, SORT_NUMERIC);
        return $ranking;
    }
}
