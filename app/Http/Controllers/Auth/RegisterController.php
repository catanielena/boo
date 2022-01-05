<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'vat_numb' => ['required', 'digits:11', 'unique:users'],
            'business_name' => ['required', 'string', 'max:30'],
            'business_address' => ['required', 'string', 'max:100'],
            'business_logo' => [ 'mimes:jpeg,png,jpg,gif,svg',' max:1000', 'nullable'],
            'business_cover' => ['mimes:jpeg,png,jpg,gif,svg',' max:1000', 'nullable'],
            'cuisines' => ['required']
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
        $business_logo = null;
        $business_cover = null;

        if(array_key_exists('business_logo', $data)) {
            $business_logo = Storage::put('image_register', $data['business_logo']);
        }
        if(array_key_exists('business_cover', $data)) {
            $business_cover = Storage::put('image_register', $data['business_cover']);
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'vat_numb' => $data['vat_numb'],
            'business_name' => $data['business_name'],
            'slug' => Str::of($data['business_name'])->slug('-'),
            'business_logo' => $business_logo,
            'business_cover' => $business_cover,
            'business_address' => $data['business_address']
        ]);
    }
}
