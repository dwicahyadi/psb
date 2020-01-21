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
                                <h3 class="card-title">User Baru</h3>
                            </div>

                            <form action="{{route('user.store')}}" class="form" method="post" enctype="multipart/form-data">

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Username</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="username" autofocus value="{{ old('username') }}" required>
                                        @if ($errors->has('username'))
                                            <span class="text-danger" role="alert">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Nama</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="name" value="{{old('name')}}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Role</label>
                                    <div class="col-md-3">
                                        <select name="role" class="form-control">
                                            @forelse($roles as $role)
                                                <option value="{{$role->name}}" @if(old('role') == $role->name) selected @endif >{{$role->name}}</option>
                                            @empty
                                                <option>Kosong</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Password</label>
                                    <div class="col-md-4">
                                        <input type="password" class="form-control" name="password" value="{{ old('password') }}" required>
                                        @if ($errors->has('password'))
                                            <span class="text-danger" role="alert">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>

                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Konfirmasi Password</label>
                                    <div class="col-md-4">
                                        <input type="password" class="form-control" name="password_confirmation" required>
                                        @if ($errors->has('password'))
                                            <span class="text-danger" role="alert">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>


                                <div class="d-flex  justify-content-between">
                                    @csrf
                                    <a href="{{route('user.index')}}" class="btn btn-secondary"><i class="fa fa-chevron-left"></i> Kembali</a>
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
