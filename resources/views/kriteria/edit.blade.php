@extends("layout")


@section('title')
<h4>Edit Criteria</h4>
@endsection
@section('content')
		@if ($errors->any())
		<div class="alert alert-danger">
			<strong>Whoops!</strong> There were some problems with your input.<br><br>
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
		<h4>Edit Alternative</h4>
		<form method="post" action="{{ route('criteria.update', $kriteria->id) }}" enctype="multipart/form-data" id="myForm">
			@csrf
			@method('PUT')
			<div class="form-group">
				<label for="nama_alternatif">Criteria</label>
				<input type="text" name="nama_kriteria" class="form-control" id="nama_kriteria"
					value="{{ $kriteria->nama_kriteria }}" aria-describedby="nama_kriteria">
			</div>
			<div class="form-group">
				<label for="bobot">Bobot</label>
				<input type="text" name="bobot" class="form-control" id="bobot"
					value="{{ $kriteria->bobot }}" aria-describedby="bobot">
			</div>
			<button type="submit" class="btn btn-primary" id = "submit">Submit</button>
		</form>
@endsection