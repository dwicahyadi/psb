@extends('layouts.medialoot')
@section('title','Pengaturan')


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
                                <h3 class="card-title">Pengaturan Sistem</h3>
                            </div>

                            <form action="{{route('update_settings')}}" class="form" method="post" enctype="multipart/form-data">

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Tahun Ajaran</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="school_year" required value="{{$setting->school_year}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">NEM Minimal</label>
                                    <div class="col-md-2">
                                        <input type="number" step="0.01" class="form-control" name="minimum_nem" required value="{{$setting->minimum_nem}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Lama Test (menit)</label>
                                    <div class="col-md-2">
                                        <input type="number" step="1" class="form-control" name="test_duration" required value="{{$setting->test_duration}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Minimal Hasil Test</label>
                                    <div class="col-md-2">
                                        <input type="number" step="1" class="form-control" name="minimum_score" required value="{{$setting->minimum_score}}">
                                    </div>
                                </div>


                                <div class="d-flex  justify-content-end">
                                    @csrf

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
                    <a href="{{route('major.destroy',['major'=> $setting, '_token'=> csrf_token()])}}" class="btn btn-secondary">Yakin</a>
                    <button type="button" class="btn btn-primary"  data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
@endsection()
