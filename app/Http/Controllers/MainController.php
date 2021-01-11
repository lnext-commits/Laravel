<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Main;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    private $iqoInvoice='bag-Black.png';
    private $tables;

    public function index ()
    {
        if (!Session::get('invoice')){
            $invoiceId = User::find(auth()->id())
                ->invoice()
                ->orderBy('sort')
                ->first()
                ->id;
            return redirect()->route('invoice.score', ['id' => $invoiceId]);
        }
        $invoices = Invoice::whereUserId(auth()->id())->orderBy('sort')->get();
        $invoice = Invoice::whereId(session('invoice'))->first();
        $balance = Invoice::getBalance(session('invoice'));
        $tables = Main::whereInvoiceId(session('invoice'))
            ->select(['main.id','main.d','main.run','main.cash','art.art_name','outgo.outgo_name', 'main.comment'])
            ->leftJoin('art', 'main.art_id','art.id')
            ->leftJoin('outgo','main.outgo_id','outgo.id')
            ->orderBy('main.d','DESC')
            ->orderBy('main.id','DESC')
          ;
        $tables = $this->period($tables);

        return view('main',[
            'invoices' => $invoices,
            'nameInvoice' => $invoice->invoice_name,
            'balance' => $balance,
            'color' => $this->getColor($balance,$invoice->color),
            'iqoInvoice' => $this->iqoInvoice,
            'tables' => $tables->get()
            ]);
    }

    private function getColor ($balance, $strColor)
    {
        list($limit1,$limit2) = explode('|', $strColor);
        if ($balance <= 0) {$this->iqoInvoice = 'bag-Red.png'; return 'color: #E06926;';}
        if ($balance < $limit1) {$this->iqoInvoice = 'bag-Yellow.png'; return 'color: #FCC00B;';}
        if ($balance < $limit2) {$this->iqoInvoice = 'bag-Blue.png'; return 'color: #76A9D0;';}
        if ($balance >= $limit2) {$this->iqoInvoice = 'bag-Green.png'; return 'color: #8AC255;';}
    }
    private function period ($main)
    {
        $year = now()->year;
        $month = now()->month;
        switch (session('period')){
            case 'year' :
                $out = $main->whereYear('d',$year);
            break;
            case 'quarter' :
                $tempD=date("m");
                $floatQuar=$tempD/3;
                $quarter= ceil ($floatQuar);
                $out = $main->whereYear('d',$year)->raw("AND QUARTER(d)={$quarter}");
            break;
            case 'range' :
                $out = $main->where('d','>=', session('beginRange'))->where('d','<=', session('endRange'));
            break;
            default :
                $out = $main->whereYear('d',$year)->whereMonth('d',$month);
            break;
        }
        return $out;
    }
}
