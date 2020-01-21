@extends('layouts.medialoot')
@section('title','Dashboard')


@section('content')
    <section class="row">
        <div class="col-md-6">
            <div class="card card-primary text-white">
                <div class="card-body d-flex justify-content-between">
                    <i class="fa fa-users fa-3x"></i>
                    <div>
                        <h3>{{$candidates->count()}}</h3>
                        <span class="card-subtitle">Calon Siswa</span>
                    </div>
                </div>
            </div>
        </div>
       <div class="col-md-6">
           <div class="card">
               <div class="card-body">
                   <h4 class="card-title">Jurusan</h4>
                   <h6 class="card-subtitle text-muted">Menampilkan calon siswa dikelompokan berdsar jurusan yang dipilih</h6>
               </div>
               <div class="card-body">
                   <table class="table">
                       <thead>
                       <tr>
                           <th>Jurusan</th>
                           <th>Dibutuhkan</th>
                           <th>Pendaftar</th>
                       </tr>
                       </thead>
                       <tbody>
                       @foreach($majors as $major)
                           <tr>
                               <td>{{$major->major_name}}</td>
                               <td>{{$major->class_open*$major->student_per_class}}</td>
                               <td>{{$major->candidates->count()}}</td>
                           </tr>
                       @endforeach
                       </tbody>
                   </table>
               </div>
           </div>

       </div>
    </section>

    <section class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar Calon Siswa Menunggu Pemriksaan Berkas</h4>
                    <h6 class="card-subtitle text-muted">Subtitle</h6>
                </div>
                <img src="holder.js/100x180/" alt="">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>NISN</th>
                            <th>Nama Lengkap</th>
                            <th>Asal Sekolah</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($candidates->where('document_pass','!=',1) as $candidate)
                            @if($candidate->skl_file && $candidate->ijazah_file && $candidate->photo)
                                <tr>
                                    <td>{{$candidate->nisn}}</td>
                                    <td>{{$candidate->full_name }}</td>
                                    <td>{{$candidate->school_origin }}</td>
                                    <td><a class="btn btn-secondary" href="{{route('candidate.show', $candidate)}}"><span class="fa fa-edit"></span> Detail</a></td>
                                </tr>
                            @endif

                        @empty

                        @endforelse

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection()
