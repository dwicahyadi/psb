<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::first();
        return view('setting.edit',['setting'=>$setting]);
    }

    public function update(Request $request)
    {
        $update = [
            'school_year' => $request['school_year'],
            'test_duration' => $request['test_duration'],
            'minimum_nem' => $request['minimum_nem'],
            'minimum_score' => $request['minimum_score'],
        ];
        if(DB::table('settings')->update($update)){
            return redirect()->back()->with(['success'=> 'Perubahan berhasil disimpan']);
        }else{
            return redirect()->back()->with(['error'=> 'terjadi kesalahan']);
        }
    }
}
