<?php

namespace App\Http\Controllers;

use App\Models\alternative;
use Illuminate\Http\Request;
use App\Models\criteria;
use DB;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriteria = DB::table('criteria')->get();
        return view ('admin.IndCri', compact('kriteria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alternative = alternative::get();
        return view('admin.AddCriteria', compact('alternative'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'criteria_name'=>'required',
            'attribute'=>'required',
            'weight'=>'required',
        ]);

        criteria::create($request->all());

        return redirect()->route('admin.criteria')
            ->with('Sukses, kriteria telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kriteria = DB::table('criteria')->where('id', $id)->first();
        return view('kriteria.edit', compact('criteria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'criteria_name'=>'required',
            'attribute'=>'required',
            'weight'=>'required',
        ]);

        criteria::find($id)->update($request->all());

        return redirect()->route ('criteria.index')
            ->with('Sukses, Kriteria berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        criteria::find($id)->delete();
        return redirect()->route('criteria.index')
            ->with('Sukses,kriteria berhasil dihapus');
    }
    public function search(Request $request)
    {
        $keyword = $request->search;
        $kriteria = criteria::where('nama_kriteria', 'like', "%" . $keyword . "%")->paginate(5);
        return view('kriteria.index', compact('kriteria'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
