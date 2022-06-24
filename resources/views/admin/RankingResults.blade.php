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
              <h4 class="card-title">Ranking Results</h4>
            </div>
          </div>
          <div class="table-responsive">
            <table style="font-size: 30px" class="table">
              <thead>
                <tr>
                  <th>Rank</th>
                  <th>Nama</th>
									<th>Grade</th>
									<th>Major</th>
									<th>GPA</th>
									<th>SKKM</th>
									<th>Parent Salary</th>
                </tr>
              </thead>
              <tbody>
                @php $no = 1; @endphp
                @foreach ($results as $result)
                <tr>
                  <td># {{$no++}}</td>
                  <td>{{$result-> nama_mahasiswa}}</td>
                  <td>{{$result-> grade}}</td>
                  <td>{{$result-> major}}</td>
                  <td>{{$result-> gpa}}</td>
                  <td>{{$result-> skkm}}</td>
                  <td>{{$result-> parentsalary}}</td>
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