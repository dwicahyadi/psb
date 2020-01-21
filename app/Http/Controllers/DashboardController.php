<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Major;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $majors = Major::all();
        $candidates = Candidate::all();

        $data = [
            'majors' =>$majors,
            'candidates' =>$candidates
        ];
        return view('dashboard.index', $data);
    }
}
