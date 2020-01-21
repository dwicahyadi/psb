<h4>{{$subjects}}</h4>
<form id="form-questions">
    @csrf
    <input type="hidden" name="subjects" value="{{$subjects}}">
    @forelse($questions as $question)
        <div class="card mb-4">
            <div class="card-header">
                @if($question->question_image)
                    <img class="card-img-top" src="{{$question->question_image}}" alt="">
                @endif
                <strong class="card-text">{{$question->question}}</strong>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <label class="list-group-item list-group-item-action"><input type="radio" name="answer[{{$question->id}}]" value="a" required> {{$question->option_a}}</label>
                    <label class="list-group-item list-group-item-action"><input type="radio" name="answer[{{$question->id}}]" value="b"> {{$question->option_b}}</label>
                    <label class="list-group-item list-group-item-action"><input type="radio" name="answer[{{$question->id}}]" value="c"> {{$question->option_c}}</label>
                    <label class="list-group-item list-group-item-action"><input type="radio" name="answer[{{$question->id}}]" value="d"> {{$question->option_d}}</label>
                </div>
            </div>
        </div>
    @empty
        <h1>Tidak ada soal</h1>

    @endforelse
        <button type="submit" class="btn btn-lg btn-primary btn-block" id="submit-test" onclick="submitTest()" onsubmit="preventDefault()">Selesai</button>
</form>
