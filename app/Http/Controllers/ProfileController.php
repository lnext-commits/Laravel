<?php

namespace App\Http\Controllers;

use App\Invoice;
use Auth;
use Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index ()
    {
        $invoices = Invoice::whereUserId(auth()->id())->orderBy('sort')->get();
        return view('profile.index',[
            'invoices' => $invoices,
            'user' => Auth::getUser()
        ]);
    }
    public function update (Request $request)
    {
        $user = Auth::getUser();
        if ($request->has('oldPassword')){
            if (Hash::check($request->oldPassword, $user->password)){
                if ($request->newPassword == $request->dblPassword){
                    Auth::user()->update([
                        'password' => $request->newPassword
                    ]);
                    Session::flash('status', "Пароль изменен!");
                }else{
                    Session::flash('attention', 'Пароли не совпадают!');
                }
            }else{
                Session::flash('attention', 'Неверный пароль!!');
            }
        }
        if ($request->has('name')){
            Auth::user()->update([
                'name' => $request->name,
                'surname' => $request->surname,
                'login' => $request->login,
            ]);
            Session::flash('status', "Данные изменены!");
        }
        return redirect(route('profile'));
    }
}
