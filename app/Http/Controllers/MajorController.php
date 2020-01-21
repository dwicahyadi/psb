<?php

namespace App\Http\Controllers;

use App\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class MajorController extends Controller
{

    public function index()
    {
        return view('major.index',['majors' => Major::all()]);
    }


    public function create()
    {
        return view('major.create');
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

        $major = new Major();
        $major->code = $request['code'];
        $major->major_name = $request['major_name'];
        $major->description = $request['description'];
        $major->logo = $url;
        $major->class_open = $request['class_open'];
        $major->student_per_class = $request['student_per_class'];


        if($major->save()){
            return redirect()->back()->with(['success'=> 'Berhasil disimpan']);
        }else{
            return redirect()->back()->with(['error'=> 'terjadi kesalahan']);
        }
    }

    public function show(Major $major)
    {
        //
    }

    public function edit(Major $major)
    {
        return view('major.edit',['major'=>$major]);
    }

    public function update(Request $request, Major $major)
    {
        $url = $major->logo;
        $file = $request['image'];

        if ($file)
        {
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public', $fileName);
            $url =  URL::asset('storage/'.$fileName);
        }

        $major->code = $request['code'];
        $major->major_name = $request['major_name'];
        $major->description = $request['description'];
        $major->logo = $url;
        $major->class_open = $request['class_open'];
        $major->student_per_class = $request['student_per_class'];


        if($major->save()){
            return redirect()->back()->with(['success'=> 'Berhasil disimpan']);
        }else{
            return redirect()->back()->with(['error'=> 'terjadi kesalahan']);
        }
    }

    public function destroy(Major $major)
    {
        if($major->delete()){
            return redirect(route('major.index'))->with(['success'=> 'Hapus berhasil']);
        }else{
            return redirect(route('major.index'))->with(['error'=> 'terjadi kesalahan']);
        }
    }
}
