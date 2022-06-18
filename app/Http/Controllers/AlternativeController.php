<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\alternative;
use DB;


class AlternativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alternatif = DB::table('alternative')->get();
        return view ('alternatif.index', compact('alternatif'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alternatif.create');
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
            'nama_alternatif'=>'required',
        ]);

        alternative::create($request->all());

        return redirect()->route('alternative.index')
            ->with('Sukses, alternatif telah ditambahkan');
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
        $alternatif = DB::table('alternative')->where('id', $id)->first();
        return view('alternatif.edit', compact('alternatif'));
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
            'nama_alternatif'=>'required',
        ]);;

        alternative::find($id)->update($request->all());

        return redirect()->route ('alternative.index')
            ->with('Sukses, alternatif berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        alternative::find($id)->delete();
        return redirect()->route('alternative.index')
            ->with('Sukses,alternatif berhasil dihapus');
    }
    public function search(Request $request)
    {
        $keyword = $request->search;
        $alternatif = alternative::where('nama_alternatif', 'like', "%" . $keyword . "%")->paginate(5);
        return view('alternatif.index', compact('alternatif'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
