<?php

namespace App\Http\Controllers;

use App\Art;
use App\Http\Requests\SetmainRunRequest;
use App\Invoice;
use App\Main;
use App\Outgo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RunController extends Controller
{
    public function income ($id)
    {
        $article =[];
        $title = 'Приход';
        $artD = Art::whereUserId(auth()->id())->where('run', 'p')->orderBy('art_name')->get()->toArray();
        foreach ($artD as $art) {
            $article[$art['id']] = [
                'name' => $art['art_name'],
                'outgo' => Art::find($art['id'])->outgo()->orderBy('outgo_name')->get(['outgo_name', 'id'])->toArray()
            ];
        }
        return view('run.index', [
            'title' => $title,
            'nameCard' => $title,
            'article' => $article,
            'artId' => $id,
            'run' => 1
        ]);
    }
    public function expenditure ($id)
    {
        $article =[];
        $title = 'Расход';
        $artD = Art::whereUserId(auth()->id())->where('run', 'm')->orderBy('art_name')->get()->toArray();
        foreach ($artD as $art) {
            $article[$art['id']] = [
                'name' => $art['art_name'],
                'outgo' => Art::find($art['id'])->outgo()->orderBy('outgo_name')->get(['outgo_name', 'id'])->toArray()
            ];
        }
        return view('run.index', [
            'title' => $title,
            'nameCard' => $title,
            'article' => $article,
            'artId' => $id,
            'run' => 0
        ]);
    }
    public function setMain (SetmainRunRequest $request)
    {
        if($request->has('d')){
            $request->session()->put('date', $request->d);
            $cash=0;
            eval('$cash='. $request->cash .';');
            Main::create([
                'invoice_id' => $request->session()->get('invoice'),
                'art_id' => $request->artId,
                'outgo_id' => $request->outgoId,
                'cash' => $cash,
                'run' => $request->run,
                'd' => $request->d,
                'comment' => $request->comment,
                'user_id' => auth()->id()
            ]);
            Session::flash('status', "Новая запись добавленна");
            if ($request->run) {
                return redirect()->route('run.income',['id' => $request->artId]);
            }else{
                return redirect()->route('run.expenditure',['id' => $request->artId]);
            }
        }
    }
    public function transfer (SetmainRunRequest $request)
    {
        if ($request->invoiceMain == $request->invoiceSecondary){
            Session::flash('warning', "Перевод не может состоятся сам в себя");
        }else{
            $invoiceIds = [ $request->invoiceMain, $request->invoiceSecondary];
            $outgo = Outgo::whereUserId(auth()->id())->where('outgo_name', 'LIKE', 'перевод')->first();
            $invoiceMain = Invoice::find($request->invoiceMain)->invoice_name;
            $invoiceSecondary = Invoice::find($request->invoiceSecondary)->invoice_name;
            $cash=0;
            eval('$cash='. $request->cash .';');
            $comment = $request->comment ?  "<br> ({$request->comment})" : "";
            foreach ($invoiceIds as $key =>$invoiceId){
                Main::create([
                    'invoice_id' => $invoiceId,
                    'art_id' => $outgo->art_id,
                    'outgo_id' => $outgo->id,
                    'cash' => $cash,
                    'run' => $key,
                    'd' => $request->d,
                    'comment' => "{$invoiceMain} => {$invoiceSecondary} {$comment}",
                    'user_id' => auth()->id()
                ]);
            }
        }
        return redirect()->route('main');
    }
    public function delRow (Request $request){
        $transferId = Outgo::whereUserId(auth()->id())->where('outgo_name', 'LIKE', 'перевод')->first()->id;
        if ($request->has('mainId')){
            $main = Main::whereId($request->mainId);
            if ($main->first()->outgo_id == $transferId) {
                $mains = Main::whereOutgoId($transferId)->where('comment', 'LIKE', $main->first()->comment)->get();
                foreach ($mains as $item){
                    $item->delete();
                }
            }else{
                try {
                    $main->delete();
                } catch (\Exception $e) {
                }
            }
        }
        return redirect(route('main'));
    }
}
