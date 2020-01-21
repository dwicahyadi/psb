<?php

namespace App\Http\Controllers;

use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function index()
    {
        return view('user.index',['users'=> User::all()]);
    }

    public function create()
    {
        return view('user.create',['roles'=>Role::all()]);
    }

    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        $user =  User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'role' => $request['role'],
            'password' => Hash::make($request['password']),
        ]);
        $user->assignRole($request['role']);
        return redirect(route('user.index'))->with(['success'=> 'User dibuat']);
    }

    public function edit(User $user)
    {
        return view('user.edit',['roles'=>Role::all(),'user'=>$user]);
    }
}
