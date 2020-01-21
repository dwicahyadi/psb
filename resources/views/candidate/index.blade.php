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
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Daftar Calon Siswa</h3>
                            </div>
                            <hr>

                            <div class="table-responsive">

                                <table class="table table-bordered table-striped" id="dataTable">
                                    <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>NISN</th>
                                        <th>Nama Lengkap</th>
                                        <th>L/P</th>
                                        <th>Asal Sekolah</th>
                                        <th>Lengkap</th>
                                        <th>Jadwal Test</th>
                                        <th></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @forelse($candidates as $candidate)
                                        <tr>
                                            <td>{{$candidate->user->username}}</td>
                                            <td>{{$candidate->nisn}}</td>
                                            <td>{{$candidate->full_name }}</td>
                                            <td>{{$candidate->sex }}</td>
                                            <td>{{$candidate->school_origin }}</td>
                                            <td>@if($candidate->photo && $candidate->skl_file && $candidate->ijazah_file) Ya @endif</td>
                                            <td>{{$candidate->test_schedule }}</td>
                                            <td><a class="btn btn-secondary" href="{{route('candidate.show', $candidate)}}"><span class="fa fa-edit"></span> Detail</a></td>
                                        </tr>
                                    @empty

                                    @endforelse

                                    </tbody>

                                </table>

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
@endsection()

@section('script')
    <script>
        $('#dataTable').dataTable();
    </script>
@endsection
