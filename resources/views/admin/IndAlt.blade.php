@extends('admin.adminHome')
@section('content')
<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title">
			<span class="page-title-icon bg-gradient-primary text-white mr-2">
				<i class="mdi mdi-home"></i>
			</span> Kategori
		</h3>
		<nav aria-label="breadcrumb">
			<ul class="breadcrumb">
				<li class="breadcrumb-item active" aria-current="page">
					<span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
				</li>
			</ul>
		</nav>
	</div>
	<div class="row">
		<div class="col-12 grid-margin">
			<div class="card">
				<div class="card-body">
					<div class="row mb-3">
						<div class="col">
							<h4 class="card-title">Data Alternative</h4>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered" id="alternativeTable">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Grade</th>
									<th>Major</th>
									<th>GPA</th>
									<th>SKKM</th>
									<th>Parent Salary</th>
									<th width="280px">Action</th>
								</tr>
							</thead>
							<tbody>
								@php $no = 1; @endphp
								@foreach ($alternative as $alt)
								<tr>
									<td>{{$no++}}</td>
									<td>{{ $alt->nama_mahasiswa }}</td>
									<td>{{ $alt->grade }}</td>
									<td>{{ $alt->major }}</td>
									<td>{{ $alt->gpa }}</td>
									<td>{{ $alt->skkm }}</td>
									<td>{{ $alt->parent_salary }}</td>
									<td>
										<form action="{{ route('alternative.destroy',['alternative'=>$alt->id]) }}" method="POST">
											<a class="btn btn-info" href=" {{route('alternative.edit',$alt->id) }}" id="edit{{$alt->id}}">Edit</i></a>
											@csrf
											@method('DELETE')
											<button type="submit" class="btn btn-danger" id="delete{{$alt->id}}">Delete</button>
										</form>
									</td>
								</tr>

								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection