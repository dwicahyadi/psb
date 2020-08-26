<?php

namespace App\Http\Controllers;

use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('user.index', ['users' => User::all()]);
    }

    public function create()
    {
        return view('user.create', ['roles' => Role::all()]);
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
        return redirect(route('user.index'))->with(['success' => 'User dibuat']);
    }

    public function edit(User $user)
    {
        return view('user.edit', ['roles' => Role::all(), 'user' => $user]);
    }

    public function update(User $user, Request $request)
    {
        $user->name  = $request['name'];
        $user->username  = $request['username'];
        $user->role  = $request['role'];

        $user->syncRoles($request['role']);
        return redirect(route('user.index'))->with(['success' => 'User diedit']);
    }

    public function editPassword(User $user)
    {
        return view('user.update_password');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
            return redirect()->back()->with(['error' => 'Password lama salah']);
        }
        //uncomment this if you need to validate that the new password is same as old one

        if (strcmp($request->get('old_password'), $request->get('new_password')) == 0) {
            return redirect()->back()->with(['error' => 'Password lama dan baru tidak boleh sama']);
        }

        $user->password = Hash::make($request->get('new_password'));
        $user->save();
        return redirect()->back()->with(['success' => 'Password diperbarui']);
    }
}
