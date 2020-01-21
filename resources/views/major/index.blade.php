@extends('layouts.medialoot')
@section('title','Jurusan')


@section('content')
    <section class="row">
        <div class="col-sm-12">
            @if ($message = Session::get('success'))
                <div class="alert bg-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <i class="fa fa-check"></i> {{ $message }}
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert bg-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <i class="fa fa-check"></i> {{ $message }}
                </div>
            @endif
            <section class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-block">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Daftar Jurusan</h3>
                                <div class="">
                                    <a href="{{route('major.create')}}" class="btn btn-primary"><i class="fa fa-plus-square-o "></i> Tambah Jurusan</a>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Jurusan</th>
                                        <th>Jumlah Kelas</th>
                                        <th></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @forelse($majors as $major)
                                        <tr>
                                            <td>@if($major->logo) <img src="{{$major->logo}}" alt="logo"
                                                                           class="img-fluid img-thumbnail" style="width: 86px"> @endif </td>
                                            <td>{{$major->major_name}}</td>
                                            <td>{{$major->class_open}} kelas ({{$major->student_per_class }} siswa/kelas)</td>
                                            <td style="width: 100px">
                                                <a class="btn btn-secondary" href="{{route('major.edit', $major)}}"><span class="fa fa-edit"></span> Detail</a>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td>Tidak ada data</td>
                                            </tr>
                                            @endforelse

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="row">
                <div class="col-12 mt-1 mb-4">Template by <a href="https://www.medialoot.com">Medialoot</a></div>
            </section>
        </div>
    </section>
@endsection()
