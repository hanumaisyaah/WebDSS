@extends("layout")

@section('title')
<h4>Input data</h4>
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
<h4 class = "mb-3">Input Data</h4>
<form method="post" action="{{ route('alternative.store') }}" enctype="multipart/form-data" id="myForm">
	@csrf
	<div class="form-group">
		<label for="nama_mahasiswa">Nama</label>
		<input type="text" name="nama_mahasiswa" class="form-control" id="nama_mahasiswa">
	</div>
	<div class="form-group">
		<label for="grade">Grade</label>
		<input type="text" name="grade" class="form-control" id="grade">
	</div>
	<div class="form-group">
		<label for="major">Major</label>
		<input type="text" name="major" class="form-control" id="major">
	</div>
	<div class="form-group">
		<label for="gpa">GPA</label>
		<input type="text" name="gpa" class="form-control" id="gpa">
	</div>
	<div class="form-group">
		<label for="skkm">SKKM</label>
		<input type="text" name="skkm" class="form-control" id="skkm">
	</div>
	<div class="form-group">
		<label for="parentsalary">Parent Salary</label>
		<input type="text" name="parentsalary" class="form-control" id="parentsalary">
	</div>
	<button type="submit" class="btn btn-primary" id = "submit">Submit</button>
</form>

@endsection