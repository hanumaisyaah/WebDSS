@extends('admin.adminHome')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
            </span> Tambah Criteria
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
                            <h4 class="card-title">Tambah Criteria</h4>
                        </div>
                        <div class="col text-right">
                            <a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-primary">Kembali</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ url('/criteria') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Criteria</label>
                                    <input required type="text" class="form-control" name="criteria_name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Attribute</label>
                                    <input required type="text" class="form-control" name="attribute">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Weight</label>
                                    <input required type="text" class="form-control" name="weight">
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success text-right">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection