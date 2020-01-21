@extends('layouts.medialoot')
@section('title','Hasil Test')


@section('content')
    <section>
        <div class="row">
            <div class="col-md-12">
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

                <form action="{{route('test.results')}}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Pilih Jurusan</label>
                        <div class="col-md-6">
                            <select type="text" name="major_id" class="form-control" required>
                                <option value="">- Pilih Juruan - </option>
                                @forelse($majors as $major)
                                    <option  @if(request('major_id') == $major->id) selected @endif value="{{$major->id}}">{{$major->major_name}}</option>
                                @empty
                                    <option value="">- Belum ada jurusan - </option>
                                @endforelse
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="submit" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <hr>
    @if(request('major_id'))
        <section>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-2">
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <td>Jurusan</td>
                                    <td>: {{$selected_major->major_name}}</td>
                                </tr>

                                <tr>
                                    <td>Jumlah Calon Siswa</td>
                                    <td>: {{$selected_major->candidates->count()}}</td>
                                </tr>

                                <tr>
                                    <td>Jumlah Siswa Dibuka</td>
                                    <td>: {{$selected_major->class_open *  $selected_major->student_per_class}}</td>
                                </tr>

                                <tr>
                                    <td>Jumlah Siswa Dinyatakan Diterima</td>
                                    <td>: <span class="text-success count" >0</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Hasil test</h4>
                            <div class="alert alert-info bg-info">
                                <i class="fa fa-info-circle"></i> Minimal score untuk lulus : <stong>{{$settings->minimum_score}}</stong>
                            </div>

                            <form action="{{route('test.admissionProcess')}}" id="form-results" method="post">
                                @csrf
                                <input type="hidden" name="major_id" value="{{request('major_id')}}">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>User</th>
                                        <th>Nama Calon Siswa</th>
                                        <th>Asal Sekolah</th>
                                        <th>NEM</th>
                                        <th>Score Ujian</th>
                                        <th>Diterima</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($i = 1)
                                    @forelse($tests as $test)
                                        @php($score = $test->testDetails->sum('score'))
                                        <td>{{$i++}}</td>
                                        <td>{{$test->user->username}}</td>
                                        <td>{{$test->user->candidate->full_name}}</td>
                                        <td>{{$test->user->candidate->school_origin}}</td>
                                        <td>{{$test->user->candidate->nem}}</td>
                                        <td>{{$score}}</td>
                                        <td>
                                            <label><input type="checkbox" name="user_id[]" class="cb-accept" value="{{$test->user->id}}" @if($score >= $settings->minimum_score) checked @endif onclick="countAccept()"> Diterima</label>
                                        </td>
                                    @empty
                                        <p>Belum ada hasil test</p>
                                    @endforelse

                                    </tbody>
                                </table>
                            </form>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
                                Proses
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Yakin unutk lanjutkan? Pendaftaran untuk jurusan ini akan ditutup. <span class="count">0</span> siswa dinyatakan diterima
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel
                                            </button>
                                            <button type="button" class="btn btn-primary" id="btn-process" onclick="$('#form-results').submit()">Lanjutkan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

@section('script')
    <script>
        function countAccept() {
            var numberOfChecked = $('input:checkbox:checked').length;
            $('.count').text(numberOfChecked);

        }

    </script>
@endsection
