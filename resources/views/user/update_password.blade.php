@extends('layouts.medialoot')
@section('title','Ganti Password')


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
                                <h3 class="card-title">Update Password</h3>
                            </div>

                            <form action="{{route('user.updatePassword')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Password Lama</label>
                                    <input type="password" class="form-control"  value="" id="old-password" name="old_password" required>
                                </div>
                                <div class="form-group">
                                    <label>Password Baru</label>
                                    <input type="password" class="form-control"  value="" id="new-password" name="new_password" required>
                                </div>
                                <div class="form-group">
                                    <label>Ketik ulang Password Baru</label>
                                    <input type="password" class="form-control"  value="" id="confirm-password" name="confirm_password" onkeyup="checkPassword()" required>
                                </div>

                                <span class="text-danger" id="unmatch-warning" style="display: none"><i class="fa fa-times"></i> Password baru yang diketikan berbeda. Periksa kembali ketikan anda</span>

                                <div class="form-group">
                                    <input type="submit" class="btn btn-success" value="Ganti Password">
                                </div>
                                <hr>

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
