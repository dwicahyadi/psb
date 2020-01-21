<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Major;
use App\Question;
use App\Setting;
use App\Test;
use App\TestDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cek = Test::where('user_id', Auth::id())->where('is_finish',true)->first();
        return view('test',['session_id'=>Session::getId(), 'cek'=>$cek]);
    }

    public function doTest(Request $request)
    {
        if($request['session_id'] == Session::getId())
        {
            $setings = Setting::first();
            $cek = Test::where('user_id', Auth::id())->first();
            if(!$cek)
            {
                Test::create([
                    'user_id' => Auth::id(),
                    'token' => Session::getId(),
                ]);
            } else{
                $cek->token = Session::getId();
                $cek->save();
            }
            return view('_test', $setings);
        }else{
            return redirect(route('test'))->with(['error'=> 'Session id berbeda']);
        }

    }

    public function checkToken(Request $request)
    {
        $test_session = Test::where('token', $request['token'])->first();
        return $test_session;
    }

    public function getQuestions(Request $request)
    {
        $questions = Question::where('subjects', $request['subjects'])->where('active', true)->inRandomOrder()->get();
        return view('__view_question', ['questions' => $questions, 'subjects'=> $request['subjects']]);
    }

    public function submitTest(Request $request)
    {
        $output = [];
        $test_session = Test::where('token', Session::getId())->first();
        if (!$test_session)
        {
            $output['status'] = 'fail';
            $output['msg'] = 'Sesi test tidak ditemukan';
            return $output;
        }
        $key_answers = Question::where('subjects', $request['subjects'])->where('active', true)->get()->keyBy('id');

        $answers = $request['answer'];
        $test_answers = [];

        foreach ($key_answers as $i => $key) {
            $score = 0;
            if ($answers[$i] == $key->answer)
            {
                $score = $key->score;
            }
            $test_answers[] = ['test_id' => $test_session->id, 'question_id' => $i, 'answer'=> $answers[$i], 'score'=>$score, ];
        }
        if (TestDetail::insert($test_answers))
        {
            $output['status'] = 'success';
            $output['msg'] = 'Berhasil disimpan. Silaka lanjutkan';
        }else{
            $output['status'] = 'fail';
            $output['msg'] = 'Terjadi kesalahan';
        }

        return $output;
    }

    public function finishTest(Request $request)
    {
        $test = Test::where('user_id', Auth::id())->first();
        if(!$test)
        {
            return 'error! sesi test tidak ditemukan';
        } else{
            $test->is_finish = true;
            $test->save();
            return redirect(route('home'))->with(['success'=> 'Berhasil disimpan']);
        }

    }


    public function review(Test $test)
    {
        $questions = Question::where('active',true)->get();
        return view('test.review',['questions'=>$questions->groupBy('subjects'), 'answers'=> $test->testDetails()->pluck('answer','question_id')->toArray()]);
    }

    public function results(Request $request)
    {
        $settings = Setting::first();
        $majors = Major::all();
        $selected_major = null;
        $tests = null;
        if ($request['major_id'])
        {
            $selected_major = Major::find($request['major_id']);
            $user_id_candidates = Candidate::where('major_id', $request['major_id'])->pluck('user_id')->toArray();
            $tests = Test::whereIn('user_id', $user_id_candidates)->get();

            if ($selected_major->is_open == false)
            {
                return redirect(route('test.results'))->with(['error'=> 'Proses penerimaan jurusan '.$selected_major->major_name.' sudah pernah dilakukan. Silakan cek menu laporan untuk melihat daftar siswa diterima']);
            }
        }
        return view('test.result',['majors'=>$majors, 'selected_major' => $selected_major, 'tests'=> $tests, 'settings'=>$settings]);

    }

    public function admissionProcess(Request $request)
    {
        Major::where('id', $request['majore_id'])->update(['is_open'=> false]);
        Candidate::whereIn('user_id', $request['user_id'])->update(['be_accepted'=> true]);

        return redirect(route('test.results'))->with(['success'=> 'Berhasil disimpan']);
    }
}
