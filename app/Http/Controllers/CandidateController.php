<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class CandidateController extends Controller
{

    public function index(Request $request)
    {
        $candidates = Candidate::all();

        return view('candidate.index',['candidates'=>$candidates]);
    }

    public function forms()
    {
        $majors = Major::all();
        return view('forms',['majors'=>$majors]);
    }

    public function create()
    {
        //
    }

    public function print(Candidate $candidate)
    {
        if ($candidate->test_schedule && $candidate->document_pass){
            return view('print_id', ['candidate'=>$candidate]);
        }else{
            return 'Belum dapat mencetak kartu peserta. Pastikan dokumen sudah dilengkapi agar dapat di verifikasi oelh panitia';
        }
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Candidate $candidate)
    {
        return view('candidate.detail', ['candidate'=>$candidate]);
    }

    public function edit(Candidate $candidate)
    {
        //
    }

    public function update(Request $request, Candidate $candidate)
    {
        $candidate->fill($request->all());

        if($candidate->save()){
            return redirect()->back()->with(['success'=> 'Berhasil disimpan']);
        }else{
            return redirect()->back()->with(['error'=> 'terjadi kesalahan']);
        }
    }

    public function upload(Request $request, Candidate $candidate, String $document)
    {
        $url = '';
        $file = $request['file'];

        if ($file)
        {
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/'.Auth::user()->username.'/', $fileName);
            $url =  URL::asset('storage/'.Auth::user()->username.'/'.$fileName);
        }

        $candidate->$document = $url;

        if($candidate->save()){
            return redirect()->back()->with(['success'=> 'Dokumen berhasil diupload']);
        }else{
            return redirect()->back()->with(['error'=> 'terjadi kesalahan']);
        }


    }

    public function removeDocument(Candidate $candidate, String $document)
    {
        $candidate->$document = null;

        if($candidate->save()){
            return redirect()->back()->with(['success'=> 'Dokumen berhasil dihapus']);
        }else{
            return redirect()->back()->with(['error'=> 'terjadi kesalahan']);
        }
    }

    public function document_pass(Candidate $candidate)
    {
        $candidate->document_pass = 1;
        $candidate->test_schedule =  date('Y-m-d', strtotime('+7 day'));
        if($candidate->save()){
            return redirect()->back()->with(['success'=> 'Dokumen berhasil diverifikasi']);
        }else{
            return redirect()->back()->with(['error'=> 'terjadi kesalahan']);
        }
    }

    public function document_fail(Candidate $candidate)
    {
        $candidate->document_pass = 0;
        $candidate->ijazah_file = null;
        $candidate->skl_file = null;
        $candidate->photo = null;
        if($candidate->save()){
            return redirect()->back()->with(['success'=> 'Dokumen dihapus']);
        }else{
            return redirect()->back()->with(['error'=> 'terjadi kesalahan']);
        }
    }

    public function report(Request $request)
    {
        $result = null;
        $majors = Major::all();
        if ($request['major_id'])
        {
            $candidates = Candidate::query();

            $candidates->where('school_year',$request['school_year'])
                ->whereIn('major_id',$request['major_id']);
            if ($request['document_pass'])
            {
                $candidates->where('document_pass',1);
            }
            if ($request['be_accepted'])
            {
                $candidates->where('be_accepted',1);
            }
            if ($request['tested'])
            {
                $candidates->wherehas('test',function ($q){ return $q->where('is_finish',true);});
            }
            $result = $candidates->get();
        }


        return view('candidate.report',['majors'=>$majors,'candidates'=>$result]);
    }
}
