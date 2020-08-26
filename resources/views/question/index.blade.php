@extends('layouts.medialoot')
@section('title','Kelola Soal')


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
                                <h3 class="card-title">Daftar Soal</h3>
                                <div class="">
                                    <a href="{{route('question.create')}}" class="btn btn-primary"><i class="fa fa-plus-square-o "></i> Buat Soal</a>
                                    <a href="{{route('question.upload')}}" class="btn btn-info text-white"><i class="fa fa-upload"></i> Upload Soal</a>
                                </div>
                            </div>
                            <div class="d-flex justify-content-start mb-2" style="overflow-y: scroll">
                                 <strong class="mr-2">Score</strong>
                                <a href="{{route('question.index')}}"  class="btn btn-sm btn-info text-white margin">Total : {{$data->where('active',1)->sum('score')}}</a>
                                @foreach($subjects as $subject)
                                    <a href="{{route('question.index',['subjects'=> $subject])}}"  class="btn btn-sm @if($subject == request('subjects')) btn-primary @else btn-secondary @endif margin">{{$subject}} : {{$data->where('subjects', $subject)->where('active',1)->sum('score')}}</a>
                                @endforeach
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Pelajaran</th>
                                        <th>Soal</th>
                                        <th>Score</th>
                                        <th>Aktif</th>
                                        <th></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @forelse(request('subjects') ? $data->where('subjects',request('subjects')) : $data as $question)
                                        <tr class="{{$question->active ? '': 'text-danger'}}">
                                            <td>{{$question->subjects}}</td>
                                            <td>{{$question->question}}</td>
                                            <td>{{$question->score}}</td>
                                            <td>{{$question->active ? 'Y': 'T'}}</td>
                                            <td style="width: 100px">
                                                <a class="btn btn-secondary" href="{{route('question.edit', $question)}}"><span class="fa fa-edit"></span> Detail</a>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td>Tidak ada data</td>
                                            </tr>
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
