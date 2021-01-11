<?php

namespace App\Http\Controllers;

use App\Art;
use App\Invoice;
use App\Main;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class InvoiceController extends Controller
{
    public function score(int $id)
    {
        session(['invoice' => $id]);
        return redirect()->route('main');
    }

    public function show()
    {
//        return now()->year;
        session(['invoice' => 0]);
        $invoices = Invoice::whereUserId(auth()->id())->orderBy('sort')->get();
        $cash = [];
        foreach ($invoices as $invoice) {
            $cash[$invoice['id']] = Invoice::getBalance($invoice['id']);
        }


        return view('invoice.index', [
            'invoices' => $invoices,
            'balance' => $cash
        ]);
    }

    public function add(Request $request)
    {
        if ($request->has('invoice_name')) {
            $rec = $request->only('sort', 'invoice_name');
            $rec['user_id'] = auth()->id();
            $invoiceId = Invoice::create($rec)->id;
            if ($request->get('balance') != 0) {
                $balance = $request->get('balance');
                $artId = User::find(auth()->id())->art()->where('run', '=', 's')->first()->id;
                Main::create([
                    'invoice_id' => $invoiceId,
                    'art_id' => $artId,
                    'outgo_id' => Art::find($artId)->outgo()->orderBy('id','DESC')->first()->id,
                    'cash' => abs($balance),
                    'run' => $balance > 0 ? 1 : 0,
                    'd' => now()->format('Y-m-d'),
                    'user_id' => auth()->id()
                ]);
                Session::flash('status', "Счет <strong>{$request->get('invoice_name')}</strong> создан!!");
            }
        }
        if ($request->has('invoiceId')) {
            $invoice = Invoice::find($request->get('invoiceId'));
            $invoice->update([
                'sort' => $request->get('sort')
            ]);
        }
        return redirect()->route('invoice.show');
    }

    public function setting(int $id , Request $request)
    {
        if ($request->has('nameInvoice')) {
            $rec['color'] = "{$request->get('limit1')}|{$request->get('limit2')}";
            $rec['invoice_name'] = $request->get('nameInvoice');
            Invoice::find($id)->update($rec);
        }
        if ($request->residue > 0){
            $artId = User::find(auth()->id())->art()->where('run', '=', 's')->first()->id;
            Main::create([
                'invoice_id' => $id,
                'art_id' => $artId,
                'outgo_id' => Art::find($artId)->outgo()->orderBy('id','DESC')->first()->id,
                'cash' => abs($request->residue),
                'run' => 1,
                'd' => now()->format('Y-m-d'),
                'user_id' => auth()->id()
            ]);
        }
        if ($request->has('delInvoice')) {
            if ($invoice = Invoice::find($id)) {
                $nameInvoice = $invoice->invoice_name;
                if ($invoice->main()->first()) {
                    Session::flash('attention', "удалить счет <strong>{$nameInvoice}</strong> не возможно, он уже исползуется!  <a href='#' class='alert-link'>список записей с этим разделом</a>");
                } else {
                    Invoice::destroy($id);
                    Session::flash('warning', "Счет <strong>{$nameInvoice}</strong> удален!!");
                    return redirect()->route('invoice.show');
                }
            } else {
                Session::flash('attention', "удаление не возможно элемент не найден!");
            }
        }
        $invoice = Invoice::find($id);
        list($limit1, $limit2) = explode('|', $invoice->color);
        $invoices = Invoice::whereUserId(auth()->id())->orderBy('sort')->get();

        return view('invoice.setting', [
            'invoices' => $invoices,
            'nameInvoice' => $invoice->invoice_name,
            'invoiceId' => $id,
            'limit1' => $limit1,
            'limit2' => $limit2,
        ]);
    }
}
