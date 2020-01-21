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
                                <h3 class="card-title">Edit Jurusan</h3>
                            </div>

                            <form action="{{route('major.update',['major'=>$major])}}" class="form" method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Logo (opsional)</label>
                                    <div class="col-md-9">
                                        @if($major->logo)
                                            <img src="{{$major->logo}}" alt="image major" class="img-thumbnail img-fluid" style="height: 186px"><br>
                                        @endif
                                        <input type="file" name="image" id="image" accept="image/*">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Kode Jurusan</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="code" required value="{{$major->code}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Nama Jurusan</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="major_name" required value="{{$major->major_name}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Deskripsi</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="description" required value="{{$major->description}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Jumlah kelas dibuka</label>
                                    <div class="col-md-1">
                                        <input type="number" class="form-control" name="class_open" min="1" value="1" required value="{{$major->class_open}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Jumlah siswa per kelas</label>
                                    <div class="col-md-1">
                                        <input type="number" class="form-control" name="student_per_class" min="1" value="20" required value="{{$major->student_per_class}}">
                                    </div>
                                </div>

                                <div class="d-flex  justify-content-between">
                                    @csrf
                                    <a href="{{route('major.index')}}" class="btn btn-secondary"><i class="fa fa-chevron-left"></i> Kembali</a>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete">
                                        <i class="fa fa-trash-o"></i>  Hapus
                                    </button>
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

    <!-- Modal -->
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Yakin hapus soal ini?
                </div>
                <div class="modal-footer">
                    <a href="{{route('major.destroy',['major'=> $major, '_token'=> csrf_token()])}}" class="btn btn-secondary">Yakin</a>
                    <button type="button" class="btn btn-primary"  data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
@endsection()
