@extends("layout")

@section('title')
<h4>Create New Jenis Menu</h4>
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
<h4 class = "mb-3">Masukan Alternatif</h4>
<form method="post" action="{{ route('alternative.store') }}" enctype="multipart/form-data" id="myForm">
	@csrf
	<div class="form-group">
		<label for="nama_alternatif">Alternative</label>
		<input type="nama" name="nama_alternatif" class="form-control" id="nama_alternatif">

	</div>
	<button type="submit" class="btn btn-primary" id = "submit">Submit</button>
</form>

@endsection