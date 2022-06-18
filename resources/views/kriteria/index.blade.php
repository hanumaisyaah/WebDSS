@extends("layout")


@section('title')
<h4>Criteria</h4>
@endsection
@section('content')
	<div class="row">
		<div class="col-lg-12">
			<div class="pull-left">
				<h2>Kriteria</h2>
			</div>
			<div class="float-left my-3">
				<a class="btn btn-primary" href="{{ route('criteria.create') }}" id = "addKriteria"> + Tambah Data</a>
			</div>
		</div>
	</div>
	<form class="form" method="get" action="{{ route('search') }}">
    <div class="form-group w-100 mb-3 ">
       
        <input type="text" name="search" class="form-control w-50 d-inline" id="search" placeholder="Masukkan keyword">
        <button type="submit" class="btn btn-primary mb-1">Cari</button>
    </div>
</form>

	@if ($message = Session::get('success'))
	<div class="alert alert-success">
		<p id = "alert">{{ $message }}</p>
	</div>
	@endif

	<table class="table table-bordered" id="CriteriaTable">
		<thead>
		<tr>
			<th>No</th>
			<th>Kriteria</th>
			<th>Bobot</th>
			<th width="280px">Action</th>
		</tr>
		</thead>
		<tbody>
		@php $no = 1; @endphp
		@foreach ($kriteria as $crt)
		
		<tr>
			<td>{{$no++}}</td>
			<td>{{ $crt->nama_kriteria }}</td>
			<td>{{ $crt->bobot }}</td>
			<td>
				<form action="{{ route('criteria.destroy',$crt->id) }}" method="POST">
					<a class="btn btn-info" href=" {{route('criteria.edit',$crt->id) }}" id = "edit{{$crt->id}}">Edit</i></a>
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-danger" id = "delete{{$crt->id}}">Delete</button>
				</form>
			</td>
		</tr>
		
		@endforeach
		</tbody>
	</table>
@endsection