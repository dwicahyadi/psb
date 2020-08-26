<?php

namespace App\Http\Controllers;

use App\Imports\QuestionsImport;
use App\Question;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $subjects = Subject::all()->pluck('subject');
        $data =  Question::all();
        return view('question.index', ['data'=> $data, 'subjects'=>$subjects]);
    }

    public function create()
    {
        $subjects = Subject::all();
        return view('question.create',['subjects'=>$subjects]);
    }

    public function store(Request $request)
    {
        $url = '';
        $file = $request['image'];

        if ($file)
        {
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public', $fileName);
            $url =  URL::asset('storage/'.$fileName);
        }



        $question = new Question();
        $question->subjects = $request['subjects'];
        $question->question = $request['question'];
        $question->question_image = $url;
        $question->option_a = $request['option_a'];
        $question->option_b = $request['option_b'];
        $question->option_c = $request['option_c'];
        $question->option_d = $request['option_d'];
        $question->answer = $request['answer'];
        $question->score = $request['score'];

        if ($request['new-subject'])
        {
            Subject::firstOrCreate(['subject'=>$request['new-subject']]);
            $question->subjects = $request['new-subject'];
        }

        if($question->save()){
            return redirect()->back()->with(['success'=> 'Berhasil disimpan']);
        }else{
            return redirect()->back()->with(['error'=> 'terjadi kesalahan']);
        }


    }

    public function show(Question $question)
    {

    }

    public function edit(Question $question)
    {
        $subjects = Subject::all();
        return view('question.edit', ['question'=>$question,'subjects'=>$subjects]);
    }

    public function update(Request $request, Question $question)
    {
        $url = $question->question_image;
        $file = $request['image'];

        if ($file)
        {
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public', $fileName);
            $url =  URL::asset('storage/'.$fileName);
        }

        $question->subjects = $request['subjects'];
        $question->question = $request['question'];
        $question->question_image = $url;
        $question->option_a = $request['option_a'];
        $question->option_b = $request['option_b'];
        $question->option_c = $request['option_c'];
        $question->option_d = $request['option_d'];
        $question->answer = $request['answer'];
        $question->score = $request['score'];
        $question->active = $request['active'] ?? 0;

        if ($request['new-subject'])
        {
            Subject::firstOrCreate(['subject'=>$request['new-subject']]);
            $question->subjects = $request['new-subject'];
        }

        if($question->save()){
            return redirect()->back()->with(['success'=> 'Perubahan berhasil disimpan']);
        }else{
            return redirect()->back()->with(['error'=> 'terjadi kesalahan']);
        }
    }

    public function destroy(Question $question)
    {

        if($question->delete()){
            return redirect(route('question.index'))->with(['success'=> 'Hapus berhasil']);
        }else{
            return redirect(route('question.index'))->with(['error'=> 'terjadi kesalahan']);
        }
    }

    public function upload()
    {
        return view('question.upload');
    }

    public function import(Request $request)
    {
        $array = Excel::import(new QuestionsImport(), request()->file('file'));
        if ($array)
        {
            return redirect(route('question.index'))->with(['success'=> 'Upload Berhasil']);
        }else{
            return redirect(route('question.index'))->with(['error'=> 'terjadi kesalahan']);
        }
    }
}
