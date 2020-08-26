@extends('layouts.medialoot')
@section('title','Calon Siswa')


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
                            <h3 class="card-title">Detail Calon Siswa</h3>
                            <table class="table table-bordered">
                                <tr>
                                    <td width="30%">User</td>
                                    <td>{{$candidate->user->username}}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Jurusan dipilih</td>
                                    <td>{{$candidate-> major_id ? $candidate->major->major_name : '**Belum memilih jurusan'}}</td>
                                </tr>
                                <tr>
                                    <td width="30%">NISN</td>
                                    <td>{{$candidate->nisn}}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Nama Lengkap</td>
                                    <td>{{$candidate->full_name}}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Kelamin</td>
                                    <td>{{$candidate->gender == 'L' ? 'Laki-laki': 'Perempuan'}}</td>
                                </tr>
                                <tr>
                                    <td width="30%">TTL</td>
                                    <td>{{$candidate->pob}}, {{date('d M Y', strtotime($candidate->dob))}}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Alamat</td>
                                    <td>{{$candidate->address}}</td>
                                </tr>

                                <tr>
                                    <td width="30%">Nama Orang Tua/Wali</td>
                                    <td>{{$candidate->parent_name}}</td>
                                </tr>

                                <tr>
                                    <td width="30%">Pekerjaan Orang Tua/Wali</td>
                                    <td>{{$candidate->parent_job}}</td>
                                </tr>

                                <tr>
                                    <td width="30%">No. Telp Orang Tua/Wali</td>
                                    <td>{{$candidate->parent_phone}}</td>
                                </tr>

                                <tr>
                                    <td width="30%">Jumlah saudara</td>
                                    <td>{{$candidate->number_of_siblings}}</td>
                                </tr>
                                <tr>
                                    <td width="30%">Asal Sekolah</td>
                                    <td>{{$candidate->school_origin}}</td>
                                </tr>
                                <tr>
                                    <td width="30%">NEM</td>
                                    <td>{{$candidate->nem}}</td>
                                </tr>
                                <tr>
                                    <td width="30%">SKL</td>
                                    <td>@if($candidate->skl_file)<a href="{{$candidate->skl_file}}" target="_blank">Tampilkan</a> @else Belum upload @endif</td>
                                </tr>
                                <tr>
                                    <td width="30%">Ijazah</td>
                                    <td>@if($candidate->ijazah_file)<a href="{{$candidate->ijazah_file}}" target="_blank">Tampilkan</a> @else Belum upload @endif</td>
                                </tr>
                                <tr>
                                    <td width="30%">Pass Foto</td><td>@if($candidate->photo)<img src="{{$candidate->photo}}" alt="photo {{$candidate->photo}}" class="photo" width="240px"> @else Belum upload @endif</td>
                                </tr>

                            </table>
                            <div class="d-flex justify-content-around mb-4">
                                @if($candidate->document_pass)
                                    <strong class="text-success">Lolos Administrasi</strong>
                                @else
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirm-pass">
                                        <i class="fa fa-check"></i> Lulus Administrasi
                                    </button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm-fail">
                                        <i class="fa fa-times-circle"></i> Tidak Lulus Administrasi
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-block">
                            <h3 class="card-title">Proses Seleksi</h3>
                            <table class="table table-bordered">

                                <tr>
                                    <td width="30%">Jadwal Test</td>
                                    <td class="d-flex justify-content-between">
                                        @if($candidate->document_pass)
                                            <span>{{date('d M Y', strtotime($candidate->test_schedule))}}</span>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#confirm-reschedule"><i class="fa fa-calendar-check-o"></i> Ubah</button>
                                        @else
                                            <span>Belum lolos administrasi</span>
                                        @endif

                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">Hasil Test</td>
                                    <td>
                                        @if(isset($candidate->user->test)) {{$candidate->user->test->testDetails->sum('score')}} @endif
                                    </td>

                                </tr>
                            </table>

                            <div class="d-flex justify-content-around mb-4">
                                @if($candidate->test_access)
                                    <span class="text-success">Akses sudah diberikan</span>

                                @else
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#confirm-test"><i class="fa fa-check"></i> Berikan Akses Test Masuk</button>
                                @endif
                                <a target="_blank" href="{{route('test.review',['test'=>$candidate->user->test])}}" class="{{!$candidate->user->test ? 'disabled' : ''}} btn btn-primary"><i class="fa fa-search"></i> Review Hasil Test Masuk</a>
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

    <!-- Modal -->
    <div class="modal fade" id="confirm-pass" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
         aria-hidden="true">
        <div class="modal-dialog modal-sm" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">sm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Nyatakan lolos administrasi. Test dijadwalkan 7 hari kedepan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="{{route('candidate.document_pass',['candidate'=> $candidate, '_token'=> csrf_token()])}}" class="btn btn-primary">Ya</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirm-fail" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
         aria-hidden="true">
        <div class="modal-dialog modal-sm" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">sm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Nyatakan tidak lolos administrasi. Semua dokumen akan dihapus agar calon siswa dapat melakukan upload ulang
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="{{route('candidate.document_fail',['candidate'=> $candidate, '_token'=> csrf_token()])}}" class="btn btn-primary">Ya</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirm-reschedule" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
         aria-hidden="true">
        <div class="modal-dialog modal-sm" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">sm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-reschedule" method="post" action="{{route('candidate.update',$candidate)}}">
                        @csrf
                        <input type="date" name="test_schedule" class="form-control" required>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="$('#form-reschedule').submit()">Ubah</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirm-test" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
         aria-hidden="true">
        <div class="modal-dialog modal-sm" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">sm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Izinkan calon siswa mengakses menu "Test Masuk". Pastikan calon siswa sudah hadir di sekolah.
                    <form id="form-test-access" method="post" action="{{route('candidate.update',$candidate)}}">
                        @csrf
                        <input type="hidden" value="1" name="test_access">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="$('#form-test-access').submit()">Izinkan</button>
                </div>
            </div>
        </div>
    </div>
@endsection()
