@extends('layouts.template')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
            alternatif Detail
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Nama: </b>{{$alternatif->nama_mahasiswa}}</li>
                    <li class="list-group-item"><b>Grade: </b>{{$alternatif->grade}}</li>
                    <li class="list-group-item"><b>Major: </b>{{$alternatif->major}}</li>
                    <li class="list-group-item"><b>GPA: </b>{{$alternatif->gpa}}</li>
                    <li class="list-group-item"><b>SKKM: </b>{{$alternatif->skkm}}</li>
                    <li class="list-group-item"><b>Parent Salary: </b>{{$alternatif->parentsalary}}</li>
                </ul>
            </div>
            <a class="btn btn-success mt-3" href="{{ route('alternatif.index') }}">Back</a>
        </div>
    </div>
</div>
@endsection
