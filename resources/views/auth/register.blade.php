@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">

                <div class="card-body">
                    <h1>Pendaftaran</h1>
                    <img
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTemRKiWi4DUz3jgecmgSZRFpBsvNWGQA-BsfeuQ1oxIUYaJuER"
                        alt="register" class="img-fluid" height="200px">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nama Lengkap</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nisn" class="col-md-4 col-form-label text-md-right">NISN</label>

                            <div class="col-md-6">
                                <input id="nisn" type="text" class="form-control{{ $errors->has('nisn') ? ' is-invalid' : '' }}" name="nisn" value="{{ old('nisn') }}" required autofocus>
                                @if ($errors->has('nisn'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nisn') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="school_origin" class="col-md-4 col-form-label text-md-right">Asal Sekolah</label>

                            <div class="col-md-6">
                                <input id="school_origin" type="text" class="form-control{{ $errors->has('school_origin') ? ' is-invalid' : '' }}" name="school_origin" value="{{ old('school_origin') }}" required>
                                @if ($errors->has('school_origin'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('school_origin') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nem" class="col-md-4 col-form-label text-md-right">NEM</label>

                            <div class="col-md-6">
                                <input id="nem" type="number" step="0.01" class="form-control{{ $errors->has('nem') ? ' is-invalid' : '' }}" name="nem" value="{{ old('nem') }}" required>

                                @if ($errors->has('nem'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nem') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="alert alert-info">Username dan password otomatis dibuatkan oleh sistem setelah berhasil mendaftar</div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Daftar Sekarang
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
