@extends("Layouts.template")

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
<div class = "page-header">
<h3 class="page-title">
			<span class="page-title-icon bg-gradient-primary text-grey mr-2">
				<div class="row justify-content-center">
			</span> Input Data
		</h3>
		
		</div>
<div class="container">
	<div class="row justify-content-center">
	
		<div class="card">
		
		<div class="card-body">
<form method="post" action="{{ route('alternative.store') }}" enctype="multipart/form-data" id="myForm">
	@csrf
	
	<div class="form-group">
		<label for="nama_mahasiswa"><Strong>Nama</label>
		<input type="text" name="nama_mahasiswa" class="form-control" id="nama_mahasiswa">
	</div><br>
	<div class="form-group">
		<label for="grade"><Strong>Grade</label>
		<input type="text" name="grade" class="form-control" id="grade">
	</div><br>
	<div class="form-group">
		<label for="major"><Strong>Major</label>
		<input type="text" name="major" class="form-control" id="major">
	</div><br>
	<div class="form-group">
		<label for="gpa"><Strong>GPA</label>
		<input type="text" name="gpa" class="form-control" id="gpa">
	</div><br>
	<div class="form-group">
		<label for="skkm"><Strong>SKKM</label>
		<input type="text" name="skkm" class="form-control" id="skkm">
	</div><br>
	<div class="form-group">
		<label for="parentsalary"><Strong>Parent Salary</label>
		<input type="text" name="parentsalary" class="form-control" id="parentsalary">
	</div><br>
	<button type="submit" class="btn btn-primary" id = "submit" ><Strong>Simpan Data</button>
</form><br>
</div>
</div>
</div>
</div>

@endsection