@extends('layouts.app')

@section('content')
    <div class="container">
        @if($cek)
            <h1>Sudah menyelesaikan test pada {{$cek->created_at}}</h1>
        @else
            {{Auth::user()->candidate->test_schedule.date('Y-m-d')}}
            @if(Auth::user()->candidate->test_schedule == date('Y-m-d'))
                <div class="row">
                    <div class="col-12">
                        @if ($message = Session::get('error'))
                            <div class="alert bg-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                <i class="fa fa-check"></i> {{ $message }}
                            </div>
                        @endif
                        <h1>Petunjuk Pelaksanaan Test Masuk</h1>
                        <ol>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in est ante. In luctus turpis.</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in est ante. In luctus turpis.</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in est ante. In luctus turpis.</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in est ante. In luctus turpis.</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in est ante. In luctus turpis.</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in est ante. In luctus turpis.</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in est ante. In luctus turpis.</li>
                        </ol>

                        <div class="bg-light p-4 text-center">
                            <h4>Untuk konfirmasi, silakan tekan tombol Mulai Ujian</h4>
                            <form action="{{route('test.start')}}" method="get">
                                <input type="hidden" name="session_id" value="{{$session_id}}">
                                @csrf
                                <button class="btn btn-lg btn-success">Mulai Ujian</button>
                            </form>

                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-around">
                        <img src="https://www.campsite.ml/static/webflow/user-login3/images/hero-2.svg" alt="humans" width="30%">
                        <div>
                            <h1 class="text-muted">Woops! Tidak dapat mengikuti Test masuk</h1>

                            @if(Auth::user()->candidate->skl_file && Auth::user()->candidate->ijazah_file && Auth::user()->candidate->photo)
                                @if(Auth::user()->candidate->test_schedule)
                                    <p class="text-muted">
                                        Jadwal Tast Masuk kamu adalah tanggal <strong>{{Auth::user()->candidate->test_schedule}}</strong> dan harus datang langsung ke SMK Manggalatama di Jl. XXXXX no 123
                                    </p>
                                @else
                                    <p>Berkas masih diperiksa panitia. Jadwal Test segera ditentukan jika semua berkas valid.</p>
                                @endif

                            @else

                                <p class="text-muted">
                                    Pertama lengkapi dulu data dan persayaratan yang dibutuhkan. Jadwal diberikan setelah berkas diperiksa panitia.
                                </p>
                                <p>
                                    <a href="{{route('forms')}}">Lengkapi di sini!</a>
                                </p>
                            @endif

                        </div>
                    </div>
                </div>
            @endif
        @endif


        <hr>


    </div>
@endsection
