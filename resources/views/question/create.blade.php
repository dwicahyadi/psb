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

                            <form action="{{route('question.store')}}" class="form" method="post" enctype="multipart/form-data" id="form-question">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Mata Pelajaran</label>
                                    <div class="col-md-4">
                                        <select name="subjects" class="form-control" id="subject">
                                            @forelse($subjects as $subject)
                                                <option value="{{$subject->subject}}">{{$subject->subject}}</option>
                                            @empty
                                            @endforelse
                                            <option value="new">***Tambah Pelajaran Baru***</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row bg-info pt-2 pb-2 text-white" id="new-subject-field" style="display: none">
                                    <label class="col-md-3 col-form-label">Mata Pelajaran Baru</label>
                                    <div class="col-md-4">
                                        <input type="text" name="new-subject" id="new-subject" class="form-control" placeholder="ketik nama mata pelajaran baru">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Pertanyaan</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="question" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Gambar (opsional)</label>
                                    <div class="col-md-9">
                                        <input type="file" name="image" id="image" accept="image/*">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Opsi A</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="option_a" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Opsi B</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="option_b" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Opsi C</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="option_c" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Opsi D</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="option_d" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Jawaban</label>
                                    <div class="col-md-1">
                                        <select name="answer" class="form-control" required>
                                            <option value="a">A</option>
                                            <option value="b">B</option>
                                            <option value="c">C</option>
                                            <option value="d">D</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Score</label>
                                    <div class="col-md-1">
                                        <input type="number" class="form-control" name="score" min="1" value="1" required>
                                    </div>
                                </div>

                                <div class="d-flex  justify-content-between">
                                    @csrf
                                    <a href="{{route('question.index')}}" class="btn btn-secondary"><i class="fa fa-chevron-left"></i> Kembali</a>
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
@endsection()

@section('script')
<script>
    $(function(){
        $('#subject').change(function () {
            if($(this).val() == 'new')
            {
                $('#new-subject-field').show(250);
            }else{
                $('#new-subject').val(null)
                $('#new-subject-field').hide(250);
            }
        });

        $('#form-question').submit(function (e) {
            if($('#new-subject').val().length > 1)
            {
                var conf = confirm('Anda menambahkan mata pelajaran baru. Harap periksa kembali. Pelajaran tidak dapat dihapus');
                if(!conf) e.preventDefault();
            }
        })
    });
</script>

@endsection
