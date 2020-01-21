@extends('layouts.medialoot')
@section('title','Review Hasil Test')


@section('content')

    @forelse($questions as $subjects => $values)
        <h3>{{$subjects}}</h3>
        @foreach($values as $question)
            <div class="card mb-4">
                <div class="card-header">
                    @if($question->question_image)
                        <img class="card-img-top" src="{{$question->question_image}}" alt="">
                    @endif
                    <strong class="card-text">{{$question->question}}</strong>
                </div>
                <div class="card-body">
                    @if(isset($answers[$question->id]))
                        @php($x='option_'.$answers[$question->id])
                        <div class="list-group">
                            <label class="">
                                @if($question->answer == $answers[$question->id]) (<i class="fa fa-check text-success"></i>) @else() (<i class="fa fa-times text-danger"></i>) @endif
                                {{$question->$x}}
                            </label>
                        </div>
                    @else
                        <label class="text-danger">Tidak dijawab</label>
                    @endif
                </div>
            </div>
        @endforeach
    @empty
        <h1>Tidak ada soal</h1>

    @endforelse

@endsection
