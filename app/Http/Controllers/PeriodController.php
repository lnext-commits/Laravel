<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PeriodController extends Controller
{
    public function setPeriod($pr)
    {
        if ($pr == 'month') {
            Session::forget('period');
        } else {
            Session::put('period', $pr);
        }
        return redirect(route('main'));
    }

    public function setRange(Request $request)
    {
        if ($request->has('begin')){
            Session::put('period','range');
            Session::put('beginRange', $request->begin);
            Session::put('endRange', $request->end);
        }
        return redirect(route('main'));
    }
}
