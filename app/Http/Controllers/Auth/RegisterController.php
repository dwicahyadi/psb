<?php

namespace App\Http\Controllers\Auth;

use App\Candidate;
use App\Setting;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private  $setting;
    public function __construct()
    {
        $this->middleware('guest');
        $this->setting = Setting::first();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $setting = Setting::first();
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'nisn' => 'string|string|max:255|unique:candidates',
            'school_origin' => 'string|max:255',
//            'email' => 'string|string|max:255|unique:users',
//            'username' => 'required|string|string|max:255|unique:users',
//            'password' => 'required|string|min:6|confirmed',
            'nem' => 'required|integer|min:'.$setting->minimum_nem,
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $last_user = User::latest()->first();
        if ($last_user)
        {
            $i = $last_user->id + 1;
        }else{
            $i= 1;
        }

        $user =  User::create([
            'name' => $data['name'],
            'username' => date('dmy').$i,
            'password' => Hash::make($data['nisn']),
        ]);
        $user->assignRole('calon siswa');

        $candidate = Candidate::create([
            'full_name' => $data['name'],
            'nisn' => $data['nisn'],
            'school_origin' => $data['school_origin'],
            'nem' => $data['nem'],
            'user_id' => $user->id,
            'school_year' => $this->setting->school_year,
        ]);

        return $user;
    }
}
