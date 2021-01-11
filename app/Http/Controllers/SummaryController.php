<?php

namespace App\Http\Controllers;

use App\Main;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    public function index(Request $request)
    {
        $result = [];
        $cash = [];
        $valDate = now()->format('Y-m-d');
        if ($request->has('dateSummary')) {
            $valDate = $request->dateSummary;
        }
        $invoices = Main::whereUserId(auth()->id())
            ->select('invoice_id')
            ->with('invoice')
            ->where('d', $valDate)
            ->groupBy('invoice_id')
            ->get();

        foreach ($invoices as $invoice) {
            $result[$invoice->invoice->invoice_name] = Main::whereUserId(auth()->id())
                ->where('d', $valDate)
                ->where('invoice_id', $invoice->invoice_id)
                ->with('art')
                ->with('outgo')
                ->get();
            $cash[$invoice->invoice->invoice_name] = $this->getSum($valDate, $invoice->invoice_id);
        }


        return view('summary.index', [
            'title' => 'Сводка трат за день',
            'result' => $result,
            'valDate' => $valDate,
            'cash' => $cash
        ]);
    }
    private function getSum ($d, $invoiceId)
    {
        $out[] = Main::whereUserId(auth()->id())->where(['d' => $d, 'run' => 0, 'invoice_id' => $invoiceId])->sum('cash');
        $out[] = Main::whereUserId(auth()->id())->where(['d' => $d, 'run' => 1, 'invoice_id' => $invoiceId])->sum('cash');
        return $out;
    }
}
