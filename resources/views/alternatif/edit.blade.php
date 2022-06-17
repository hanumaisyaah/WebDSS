@extends("layout")


@section('title')
<h4>Edit Alternative</h4>
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
		<form method="post" action="{{ route('alternative.update', $alternatif->id) }}" enctype="multipart/form-data" id="myForm">
			@csrf
			@method('PUT')
			<div class="form-group">
				<label for="nama_alternatif">Alternative</label>
				<input type="text" name="nama_alternatif" class="form-control" id="nama_alternatif"
					value="{{ $alternatif->nama_alternatif }}" aria-describedby="nama_alternative">
			</div>
			<button type="submit" class="btn btn-primary" id = "submit">Submit</button>
		</form>
@endsection