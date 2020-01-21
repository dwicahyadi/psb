@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Auth::user()->candidate->document_pass)
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body text-center bg-info text-white p-4">
                            <i class="fa fa-check fa-3x"></i>
                            <h4>Selamat kamu lulus administrasi</h4>
                            <p>Silakan datang ke SMK Manggalatama tanggal <strong>{{date('d M Y', strtotime(Auth::user()->candidate->test_schedule))}}</strong> pukul 09:00 WIB dengan membawa kartu peserta berikut ini.</p>
                            <a class="btn btn-light" target="_blank" href="{{route('print', Auth::user()->candidate)}}">Cetak kartu peserta</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-6">
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

                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title">Data Pribadi</h4>
                            <form action="{{route('candidate.update', ['candidate'=> Auth::user()->candidate])}}" method="post">
                                @csrf
                                <table class="table">
                                    <tr>
                                        <td width="30%">Username</td>
                                        <td><strong>{{ Auth::user()->username }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td width="30%">Nama Lengkap</td>
                                        <td><input type="text" name="full_name" class="form-control" value="{{ Auth::user()->candidate->full_name }}" required></td>
                                    </tr>

                                    <tr>
                                        <td width="30%">Jenis Kelamin</td>
                                        <td>
                                            <select name="sex" class="form-control" required>
                                                <option @if(Auth::user()->candidate->sex == 'L') selected @endif value="L">Laki-laki</option>
                                                <option @if(Auth::user()->candidate->sex == 'P') selected @endif value="P">Perempuan</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td width="30%">Tempat Lahir</td>
                                        <td><input type="text" name="pob" class="form-control" value="{{ Auth::user()->candidate->pob }}" required></td>
                                    </tr>

                                    <tr>
                                        <td width="30%">Tanggal Lahir</td>
                                        <td><input type="date" name="dob" class="form-control" value="{{ Auth::user()->candidate->dob }}" required></td>
                                    </tr>

                                    <tr>
                                        <td width="30%">Alamat</td>
                                        <td><textarea name="address" class="form-control" required>{{ Auth::user()->candidate->address }}</textarea></td>
                                    </tr>


                                </table>
                                <input type="submit" value="Simpan" class="btn btn-primary float-right">
                            </form>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title">Data Akademi</h4>
                            <form action="{{route('candidate.update', ['candidate'=> Auth::user()->candidate])}}" method="post">
                                @csrf
                                <table class="table">

                                    <tr>
                                        <td width="30%">Jurusan dipilih</td>
                                        <td>
                                            <select type="text" name="major_id" class="form-control"required>
                                                <option value="">- Pilih Juruan - </option>
                                                @forelse($majors as $major)
                                                    <option  @if(Auth::user()->candidate->major_id == $major->id) selected @endif value="{{$major->id}}">{{$major->major_name}}</option>
                                                @empty
                                                    <option value="">- Belum ada jurusan - </option>
                                                @endforelse
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="30%">NISN</td>
                                        <td><input type="text" name="nisn" class="form-control" value="{{ Auth::user()->candidate->nisn }}" readonly required></td>
                                    </tr>
                                    <tr>
                                        <td width="30%">NEM</td>
                                        <td><input type="text" name="nem" class="form-control" value="{{ Auth::user()->candidate->nem }}" readonly required></td>
                                    </tr>
                                    <tr>
                                        <td width="30%">Asal Sekolah</td>
                                        <td><input type="text" name="school_origin" class="form-control" value="{{ Auth::user()->candidate->school_origin }}" required style="text-transform:uppercase" ><small>*Gunakan huruf kapital</small></td>
                                    </tr>
                                </table>
                                <input type="submit" value="Simpan" class="btn btn-primary float-right">
                            </form>

                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title">Upload Berkas</h4>
                            <table class="table">

                                <tr>
                                    <td width="30%">SKL</td>
                                    <td>
                                        @if(Auth::user()->candidate->skl_file)
                                            <a href="{{Auth::user()->candidate->skl_file}}" target="_blank"><span class="fa fa-file-pdf"></span> Tampilkan</a> | <a href="{{route('candidate.remove_document',['candidate'=> Auth::user()->candidate, 'document' => 'skl_file','_token'=>csrf_token()])}}"><span class="fa fa-trash"></span> Hapus Berkas</a>
                                        @else
                                            <form action="{{route('candidate.upload', ['candidate'=> Auth::user()->candidate, 'document' => 'skl_file'])}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="file" name="file">
                                                <button type="submit">Upload</button>
                                            </form>

                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Ijazah</td>
                                    <td>
                                        @if(Auth::user()->candidate->ijazah_file)
                                            <a href="{{Auth::user()->candidate->ijazah_file}}" target="_blank"><span class="fa fa-file-pdf"></span> Tampilkan</a> | <a href="{{route('candidate.remove_document',['candidate'=> Auth::user()->candidate, 'document' => 'ijazah_file','_token'=>csrf_token()])}}"><span class="fa fa-trash"></span> Hapus Berkas</a>
                                        @else
                                            <form action="{{route('candidate.upload', ['candidate'=> Auth::user()->candidate, 'document' => 'ijazah_file'])}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="file" name="file">
                                                <button type="submit">Upload</button>
                                            </form>

                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Pass Foto</td>
                                    <td>
                                        @if(Auth::user()->candidate->photo)
                                            <img src="{{Auth::user()->candidate->photo}}" alt="" class="photo" width="200px"> | <a href="{{route('candidate.remove_document',['candidate'=> Auth::user()->candidate, 'document' => 'photo','_token'=>csrf_token()])}}"><span class="fa fa-trash"></span> Hapus Berkas</a>
                                        @else
                                            <form action="{{route('candidate.upload', ['candidate'=> Auth::user()->candidate, 'document' => 'photo'])}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="file" name="file" accept="image/*">
                                                <button type="submit">Upload</button>
                                            </form>

                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>


                </div>
                <div class="col-md-6">
                    <div class="alert alert-info">
                        <p>Setelah lengkap berkas akan di verisfikasi oleh panitia. Setelah verifikasi berhasil selanjutnya akan ditentukan jadwal Test Masuk</p>
                    </div>

                    @if(Auth::user()->candidate->skl_file && Auth::user()->candidate->ijazah_file && Auth::user()->candidate->photo)

                    @else
                        <div class="alert alert-warning">
                            <p>Berkas belum lengkap</p>
                        </div>
                    @endif


                </div>
            </div>
        @endif



    </div>
@endsection
