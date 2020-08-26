@extends('layouts.medialoot')
@section('title','Laporan Calon Siswa')


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
                    <form action="{{route('candidate.report')}}" method="get" >
                        <div class="form-group row">
                            <label class="col-md-2">Tahun Ajaran</label>
                            <div class="col-md-4">
                                <select name="school_year" class="form-control">
                                    <option value="2020/2021">2020/2021</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2">Jurusan</label>
                            <div class="col-md-10">
                                @forelse($majors as $major)
                                    <label class="mr-2"><input type="checkbox" name="major_id[]" value="{{$major->id}}" @if( in_array($major->id,request('major_id') ?? [])) checked @endif> {{$major->major_name}}</label>
                                @empty
                                    Tidak ada jurusan
                                @endforelse
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2">Filter</label>
                            <div class="col-md-10">
                                <label class="mr-2"><input type="checkbox" name="document_pass" value="1" @if(request('document_pass')) checked @endif>Lulus Administrasi</label>
                                <label class="mr-2"><input type="checkbox" name="tested" value="1" @if(request('tested')) checked @endif>Sudah Mengikuti Test</label>
                                <label class="mr-2"><input type="checkbox" name="be_accepted" value="1" @if(request('be_accepted')) checked @endif>Hanya Diterima</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2"></label>
                            <div class="col-md-10">
                                @csrf
                                <button type="submit" class="btn btn-primary"><i class="fa fa-files-o"></i> Tampilkan laporan</button>
                            </div>
                        </div>
                    </form>
                    @if($candidates)
                        <div class="card mb-4">
                            <div class="card-block">
                                <div class="d-flex justify-content-between">
                                </div>
                                <hr>

                                <div class="table-responsive">
                                    @if(count($candidates) > 0 )
                                        <a href="{{route('candidate.export',@request()->all())}}" class="btn btn-success">Export ke Excel</a>
                                    @endif

                                    <table class="table table-bordered table-striped" id="dataTable">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>User</th>
                                            <th>NISN</th>
                                            <th>Asal Sekolah</th>
                                            <th>NEM</th>
                                            <th>Nama Lengkap</th>
                                            <th>L/P</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Alamat</th>
                                            <th>Nama Orang Tua/Wali</th>
                                            <th>Pekerjaan Orang Tua/Wali</th>
                                            <th>No Telp Orang Tua/Wali</th>
                                            <th>Jumlah Saudara</th>
                                            <th>Jurusan</th>
                                            <th>Kelengkapan Administrasi</th>
                                            <th>Jadwal Test</th>
                                            <th>Hasil Test</th>
                                            <th>Diterima</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @php($i=1)
                                        @forelse($candidates as $candidate)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$candidate->user->username}}</td>
                                                <td>{{$candidate->nisn}}</td>
                                                <td>{{$candidate->school_origin }}</td>
                                                <td>{{$candidate->nem }}</td>
                                                <td>{{$candidate->full_name }}</td>
                                                <td>{{$candidate->gender }}</td>
                                                <td>{{$candidate->pob }}</td>
                                                <td>{{date('d/m/Y', strtotime($candidate->dob)) }}</td>
                                                <td>{{$candidate->address }}</td>
                                                <td>{{$candidate->parent_name }}</td>
                                                <td>{{$candidate->parent_job }}</td>
                                                <td>{{$candidate->parent_phone }}</td>
                                                <td>{{$candidate->number_of_siblings }}</td>
                                                <td>{{$candidate->major->major_name ?? 'Belum dipilih' }}</td>
                                                <td>@if($candidate->photo && $candidate->skl_file && $candidate->ijazah_file) Ya @endif</td>
                                                <td>{{$candidate->test_schedule ?? 'Belum ditentukan' }}</td>
                                                <td>{{$candidate->user->test ? $candidate->user->test->testDetails->sum('score') : 'Belum ikut test' }}</td>
                                                <td>{{$candidate->be_accepted ? 'Diterima' : '' }}</td>
                                            </tr>
                                        @empty

                                        @endforelse

                                        </tbody>

                                    </table>

                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </section>
            <section class="row">
                <div class="col-12 mt-1 mb-4">Template by <a href="https://www.medialoot.com">Medialoot</a></div>
            </section>
        </div>
    </section>
@endsection()

@section('script')
    <script>
        $('#dataTable').dataTable();
    </script>
@endsection
