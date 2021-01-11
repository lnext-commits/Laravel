<?php

namespace App\Http\Controllers\Ajax;

use App\Art;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\Main;
use App\Outgo;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function editMainRow(Request $request)
    {
        if ($request->ajax()) {
            $invoices = Invoice::whereUserId(auth()->id())->orderBy('sort')->get();
            $arts = Art::whereUserId(auth()->id())->orderBy('art_name')->get(['art_name', 'id']);
            $outgos = Outgo::whereUserId(auth()->id())->orderBy('outgo_name')->get(['outgo_name', 'id']);
            $main = Main::find($request->id);
            return view('ajax.editRow',[
                'invoices' => $invoices,
                'arts' => $arts,
                'outgos' => $outgos,
                'main' => $main
                ]);
        }
    }
    public function saveMainRow (Request $request)
    {
        if ($request->ajax()) {
            Main::find($request->id)
                ->update([
                    'invoice_id' => $request->invoice,
                    'art_id' => $request->art,
                    'outgo_id' => $request->outgo,
                    'cash' => $request->cash,
                    'd' => $request->d,
                    'comment' => $request->comment,
                ]);
            $main = Main::find($request->id);
            return view('ajax.viewRow',[
                'main' => $main
                ]);
        }
    }
}
