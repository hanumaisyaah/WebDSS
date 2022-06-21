@extends('layouts.app')

@section('content')
  
    <div class ="container">
<div class="row justify-content-center">
  <div class="card col-lg-3 m-4">
    <div class="card-body">
      <h5 class="card-title">Daftar</h5>
      <p class="card-header bg-primary">Form in hanya dapat diisi sekali. Mohon mengisi dengan teliti</p>
      <div class="float-left my-3">
				<a class="btn btn-primary" href="{{ route('alternative.create') }}" id = "addAlternative"> + Input Data</a>
			</div>
    </div>
  </div>
  <div class="card col-lg-3 m-4">
    <div class="card-body">
      <h5 class="card-title">Lihat pengumuman</h5>
      <p class="card-header bg-success">Silahkan klik button dibawah untuk melihat hasil pengumuman</p>
      <div class="float-left my-3">
				<a class="btn btn-primary" href="{{ route('alternative.create') }}" id = "addAlternative"> Lihat Hasil Pengumuman</a>
			</div>
    </div>
  </div>
</div>
</div>
@endsection