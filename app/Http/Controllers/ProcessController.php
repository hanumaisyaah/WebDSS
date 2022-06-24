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
            ->get(['id', 'nama_mahasiswa', 'grade', 'major', 'gpa', 'skkm', 'parentsalary']);
        $cartoons = Alternative::get(['id', 'nama_mahasiswa', 'grade', 'major', 'gpa', 'skkm', 'parentsalary']);
        $criteria = Criteria::all();
        Session::flash('success', $results[0]->cartoon_name . ' is the highest-ranking among all your choices');
        return view('RankingResults', compact('alternative', 'criteria', 'results'));
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
    public function minMax($criteria, $alternative, $weighted)
    {
        $scores = $weighted;
        $max = array();
        $min = array();
        foreach ($alternative as $alter) {
            $valueMax = 0;
            $valueMin = 0;
            foreach ($criteria as $criterion) {
                if ($criterion->criteria_type == 'benefit') {
                    $valueMax +=  $scores[$alter][$criterion->criteria_name];
                } else if ($criterion->criteria_type == 'cost') {
                    $valueMin +=  $scores[$alter][$criterion->criteria_name];
                }
            }
            $max[$alter] = $valueMax;
            $min[$alter] = $valueMin;
        }
        return $this->ranking($alter, $max, $min);
    }
    public function ranking($alternative, $max, $min)
    {
        $ranking = array();
        dd($ranking);
        if(is_array($ranking) || is_object($ranking)){
            foreach ($alternative as $alter) {
                $value = $max[$alter] - $min[$alter];
                $ranking[$alter] = $value;
            }
        }
        return $this->sort($ranking);
    }
    public function sort($ranking)
    {
        arsort($ranking, SORT_NUMERIC);
        return $ranking;
    }
}
