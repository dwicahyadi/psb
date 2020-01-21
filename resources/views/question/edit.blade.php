@extends('layouts.medialoot')
@section('title','Form Soal')


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
                                <h3 class="card-title">Soal Baru</h3>
                            </div>

                            <form action="{{route('question.update',['question'=>$question])}}" class="form" method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Mata Pelajaran</label>
                                    <div class="col-md-4">
                                        <select name="subjects" class="form-control">
                                            <option @if($question->subjects == 'Matematika') selected @endif value="Matematika">Matematika</option>
                                            <option @if($question->subjects == 'Bahasa Indonesia') selected @endif value="Bahasa Indonesia">Bahasa Indonesia</option>
                                            <option @if($question->subjects == 'Bahasa Inggris') selected @endif value="Bahasa Inggris">Bahasa Inggris</option>
                                            <option @if($question->subjects == 'Kewarganegaraan') selected @endif value="Kewarganegaraan">Kewarganegaraan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Pertanyaan</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="question" required>{{$question->question}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Gambar (opsional)</label>
                                    <div class="col-md-9">
                                        @if($question->question_image)
                                            <img src="{{$question->question_image}}" alt="image question" class="img-thumbnail img-fluid">
                                        @endif
                                        <input type="file" name="image" id="image">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Opsi A</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="option_a" required value="{{$question->option_a}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Opsi B</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="option_b" required value="{{$question->option_b}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Opsi C</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="option_c" required value="{{$question->option_c}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Opsi D</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="option_d" required value="{{$question->option_d}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Jawaban</label>
                                    <div class="col-md-1">
                                        <select name="answer" class="form-control" required>
                                            <option @if($question->answer == 'a') selected @endif  value="a">A</option>
                                            <option @if($question->answer == 'b') selected @endif  value="b">B</option>
                                            <option @if($question->answer == 'c') selected @endif  value="c">C</option>
                                            <option @if($question->answer == 'd') selected @endif  value="d">D</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Score</label>
                                    <div class="col-md-1">
                                        <input type="number" class="form-control" name="score" min="1" value="{{$question->score}}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Aktif</label>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="active" value="1" {{$question->active ? 'checked' : ''}}>
                                    </div>
                                </div>

                                <div class="d-flex  justify-content-between">
                                    @csrf
                                    <a href="{{route('question.index')}}" class="btn btn-secondary"><i class="fa fa-chevron-left"></i> Kembali</a>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete">
                                        <i class="fa fa-trash-o"></i>  Hapus
                                    </button>
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



    <!-- Modal -->
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Yakin hapus soal ini?
                </div>
                <div class="modal-footer">
                    <a href="{{route('question.destroy',['question'=> $question, '_token'=> csrf_token()])}}" class="btn btn-secondary">Yakin</a>
                    <button type="button" class="btn btn-primary"  data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
@endsection()
