@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="text-muted">Selamat datang {{ Auth::user()->name }}!</h2>
        {{--Lolos Administrasi ?--}}
        @if(Auth::user()->candidate->document_pass && !isset($test->id))
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
        @endif

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                Untuk login berikutnya silakan gunakan : <br>
                Username : <strong>{{Auth::user()->username}}</strong><br>
                Password : <strong>Nomor Induk Siswa Nasional</strong> milik kamu
            </div>

        <div class="row mt-2">
            <div class="col-md-6">

                <table class="table">
                    <tr>
                        <td width="30%">Username</td>
                        <td><strong>{{ Auth::user()->username }}</strong></td>
                    </tr>
                    <tr>
                        <td width="30%">Nama Calon Siswa</td>
                        <td><strong>{{ Auth::user()->candidate->full_name }}</strong></td>
                    </tr>
                    <tr>
                        <td width="30%">NISN</td>
                        <td><strong>{{ Auth::user()->candidate->nisn }}</strong></td>
                    </tr>
                    <tr>
                        <td width="30%">Asal Sekolah</td>
                        <td><strong>{{ Auth::user()->candidate->school_origin }}</strong></td>
                    </tr>
                    <tr>
                        <td width="30%">Jurusan dipilih</td>
                        <td class="d-flex justify-content-between">
                            @if(Auth::user()->candidate->major_id)
                                <strong>{{Auth::user()->candidate->major->major_name}}</strong>
                            @else
                                <strong class="text-danger">Belum Dipilih</strong>
                                <a href="{{route('forms')}}" >Pilih disini</a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Kelengkapan Berkas</td>
                        <td class="d-flex justify-content-between">
                            @if(Auth::user()->candidate->skl_file && Auth::user()->candidate->ijazah_file && Auth::user()->candidate->photo)
                                <strong>Lengkap</strong>
                            @else
                                <strong class="text-danger">Menunggu dilengkapi</strong>
                                <a href="{{route('forms')}}" >Lengkapi disini</a>
                            @endif

                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Jadwal Test Masuk</td>

                        <td>
                            @if(Auth::user()->candidate->test_schedule)
                                <strong>{{Auth::user()->candidate->test_schedule}}</strong>
                            @else
                                <strong>Ditentukan setelah berkas diperiksa panitia</strong>
                            @endif

                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQv-cCrUy9D0gmN9kT2EW_nZDJDQLXGnDsnqYXgookooNi3pt7n"
                    alt="home" class="img-fluid">
            </div>
        </div>
        <div class="row justify-content-center align-items-center bg-light p-2">
            <div class="col-md-3">


                @if(Auth::user()->candidate->document_pass)
                    <a href="{{route('forms')}}" class="btn btn-success shadow btn-block p-4">
                        <i class="fas fa-check fa-2x"></i><br>
                        <small>Berkas lengkap</small>
                    </a>
                @else
                    <a href="{{route('forms')}}" class="btn btn-outline-success shadow btn-block p-4">
                        <i class="fas fa-address-card fa-2x"></i><br>
                        <strong>1. Lengkapi Data</strong>
                    </a>
                @endif
            </div>

            <div class="col-md-3">
                @if(isset($test->is_finish))
                    <a href="{{route('test')}}" class="btn btn-success shadow btn-block p-4">
                        <i class="fas fa-check fa-2x"></i><br>
                        <small>Sudah dilakasanakan test</small>
                    </a>
                @else
                    <a href="{{route('test')}}" class="btn btn-outline-success shadow btn-block p-4">
                        <i class="fas fa-pencil-alt fa-2x"></i><br>
                        <strong>2. Ikuti Test</strong>
                    </a>
                @endif

            </div>

            <div class="col-md-3">
                @if(isset(Auth::user()->candidate->major) && Auth::user()->candidate->major->is_open == false)
                    <a href="#resultModal" class="btn btn-success shadow btn-block p-4" data-toggle="modal">
                        <i class="fas fa-award fa-2x"></i><br>
                        <small>Klik untuk melihat hasil</small>
                    </a>
                @else
                    <a href="#" class="btn btn-outline-success shadow btn-block p-4 disabled">
                        <i class="fas fa-award fa-2x"></i><br>
                        <strong>3. Lihat Hasil</strong>
                    </a>
                @endif

            </div>
        </div>
    </div>

    <div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pengumuman Hasil Test</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if(Auth::user()->candidate->be_accepted)
                        <h4>Selamat kamu diterima di SMK Manggalatama Jurusan {{Auth::user()->candidate->major->major_name}}</h4>
                    @else
                        <h4>Mohon maaf kamu belum bisa diterima di SMK Manggalatama</h4>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                    </button>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('script')
    @if(isset(Auth::user()->candidate->major) && Auth::user()->candidate->major->is_open == false)
        <script>
            $('#resultModal').modal('show');
        </script>
    @endif
@endsection

