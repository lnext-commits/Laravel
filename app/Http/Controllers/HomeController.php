<?php

namespace App\Http\Controllers;

use App\Art;
use App\User;

class HomeController extends Controller
{
    public function __construct()
    {
        return redirect(route('password.confirm'));
    }

    public function index()
    {

        $inp=0;
        $str='$inp = 25+65;';
       eval($str);

//       dd($inp);
        $artId = User::find(auth()->id())->art()->where('run', '=', 's')->first()->id;
       $test = Art::find($artId)->outgo()->orderBy('id','DESC')->first()->id;
       dd($test);
    }
}
