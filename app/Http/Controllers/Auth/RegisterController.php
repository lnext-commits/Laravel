<?php

namespace App\Http\Controllers\Auth;

use App\Art;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\Outgo;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::MAIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showRegistrationForm()
    {
        return view('auth.register',  [
            'registerActive' => 'active',
            'invoices' => [],
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:150'],
            'surname' => ['required', 'string', 'max:150'],
            'login' => ['required', 'string', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $rez = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'login' => $data['login'],
            'password' => $data['password'],
        ]);
         Invoice::create([
            'invoice_name' => 'Основной',
            'user_id' =>  $rez->id
        ]);
        $duty = Art::create([
            'art_name' => 'Служебный',
            'run' => 's',
            'user_id' => $rez->id
        ]);
        $yield = Art::create([
            'art_name' => 'Доход',
            'run' => 'p',
            'user_id' => $rez->id
        ]);
        $rate = Art::create([
            'art_name' => 'Расход',
            'run' => 'm',
            'user_id' => $rez->id
        ]);
        Outgo::create([
            'outgo_name' => 'перевод',
            'art_id' => $duty->id,
            'user_id' => $rez->id
        ]);
        Outgo::create([
            'outgo_name' => 'ввод остатка',
            'art_id' => $duty->id,
            'user_id' => $rez->id
        ]);
        Outgo::create([
            'outgo_name' => 'Дополнительные',
            'art_id' => $yield->id,
            'user_id' => $rez->id
        ]);
        Outgo::create([
            'outgo_name' => 'Разные покупки',
            'art_id' => $rate->id,
            'user_id' => $rez->id
        ]);
        return $rez;
    }
}
