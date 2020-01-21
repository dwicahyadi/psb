@extends('layouts.medialoot')
@section('title','Form Jurusan')


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
                                <h3 class="card-title">Jurusan Baru</h3>
                            </div>

                            <form action="{{route('major.store')}}" class="form" method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Logo (opsional)</label>
                                    <div class="col-md-9">
                                        <input type="file" name="image" id="image" accept="image/*">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Kode Jurusan</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="code" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Nama Jurusan</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="major_name" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Deskripsi</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="description" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Jumlah kelas dibuka</label>
                                    <div class="col-md-1">
                                        <input type="number" class="form-control" name="class_open" min="1" value="1" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Jumlah siswa per kelas</label>
                                    <div class="col-md-1">
                                        <input type="number" class="form-control" name="student_per_class" min="1" value="20" required>
                                    </div>
                                </div>

                                <div class="d-flex  justify-content-between">
                                    @csrf
                                    <a href="{{route('major.index')}}" class="btn btn-secondary"><i class="fa fa-chevron-left"></i> Kembali</a>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Simpan</button>
                                </div>


                            </form>
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
