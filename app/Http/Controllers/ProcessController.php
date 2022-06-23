<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Models\Alternative;
use DB;

class ProcessController extends Controller
{
    public function welcome()
    {
        $criteria = DB::table('criteria')->get();
        return view('welcome', compact('criteria'));
    }

    public function index(Request $request)
    {

        $weight = $request->get('weight');
        $location_selected = $request->get('option');
        $selected_alternative = Alternative::whereIn('id_location', $location_selected)->get();
        $count = count($location_selected);
        $value_location = array();
        for ($i = 1; $i <= count($location_selected); $i++) {
            $value_location[$location_selected[$i]]['value'] = $count;
            $count--;
        }


        // get determine matrix
        $criteria_name_pluck = Criteria::pluck('criteria_name');
        $determine_matrix = array();
        foreach ($selected_alternative as $alternative) {
            $determine_matrix[$alternative->id]['id'] = $alternative->id;
            foreach ($criteria_name_pluck as $c) {
                if ($c == 'location') {
                    $determine_matrix[$alternative->id]['location'] = $value_location[$alternative->id_location]['value'];
                } else {
                    $determine_matrix[$alternative->id][$c] = $alternative->$c;
                }
            }
        }



        // Normalized 
        $normalized_matrix = array();
        $criteria = DB::table('criteria')->get();
        $total_criteria = count($criteria);
        for ($a = 1; $a <= $total_criteria; $a++) {
            for ($b = 0; $b < count($determine_matrix); $b++) {
                $value = pow($determine_matrix[$selected_alternative[$b]->id][$criteria[$a - 1]->criteria_name], 2);
                $normalized_matrix[$selected_alternative[$b]->id][$criteria[$a - 1]->criteria_name] = $value;
            }
            $sum_value = array_sum(array_column($normalized_matrix, $criteria[$a - 1]->criteria_name));
            $sqrt_value = sqrt($sum_value);

            for ($i = 0; $i < count($determine_matrix); $i++) {
                $normalized_matrix[$selected_alternative[$i]->id][$criteria[$a - 1]->criteria_name] = $determine_matrix[$selected_alternative[$i]->id][$criteria[$a - 1]->criteria_name] / $sqrt_value;
            }
        }


        // Weighted Normalized
        $weighted_normalized = array();
        for ($a = 1; $a <= count($criteria); $a++) {
            for ($b = 0; $b < count($determine_matrix); $b++) {
                $weighted_value = $normalized_matrix[$selected_alternative[$b]->id][$criteria[$a - 1]->criteria_name] * $weight[$criteria[$a - 1]->criteria_name];
                $weighted_normalized[$selected_alternative[$b]->id][$criteria[$a - 1]->criteria_name] = $weighted_value;
            }
        }

        // Y min max
        $max_value = array();
        $min_value = array();

        for ($a = 0; $a < count($determine_matrix); $a++) {
            $valueMax = 0;
            $valueMin = 0;
            for ($b = 1; $b <= count($criteria); $b++) {
                if ($criteria[$b - 1]->attribute == 2) {
                    $valueMax += $weighted_normalized[$selected_alternative[$a]->id][$criteria[$b - 1]->criteria_name];
                } else {
                    $valueMin += $weighted_normalized[$selected_alternative[$a]->id][$criteria[$b - 1]->criteria_name];
                }
            }
            $max_value[$selected_alternative[$a]->id] = $valueMax;
            $min_value[$selected_alternative[$a]->id] = $valueMin;
        }


        // Get the Rank

        $ranking = array();
        for ($a = 0; $a < count($determine_matrix); $a++) {
            $yi_value = $max_value[$selected_alternative[$a]->id] - $min_value[$selected_alternative[$a]->id];
            $ranking[$selected_alternative[$a]->id] = $yi_value;
        }
        arsort($ranking, SORT_NUMERIC);
        $ranked = array_keys($ranking);
        $sorted_ranked = implode(',', $ranked);
        $results = Alternative::whereIntegerInRaw('id', $ranked)
            ->orderByRaw(Alternative::raw("FIELD(id, $sorted_ranked)"))
            ->get(['id', 'university']);
        $location = DB::table('location')->get();
        return view('result', compact('location', 'criteria', 'results'));
    }


    public function reset(Request $request)
    {
        $criteria = DB::table('criteria')->get();
        $location = DB::table('location')->get();
        return view('welcome', compact('location', 'criteria'));
    }
}
