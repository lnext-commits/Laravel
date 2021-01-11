<?php

namespace App\Http\Controllers;

use App\Art;
use App\Invoice;
use App\Main;
use App\Outgo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ArtController extends Controller
{
    private $groupIn = 'доход';
    private $groupOut = 'расход';

    public function show(int $id)
    {
        $article = [];
        $articleS = [];
        $articleD = [];
        $articleR = [];
        $invoices = Invoice::whereUserId(auth()->id())->orderBy('sort')->get();
        /*
        $artS = Art::whereUserId(auth()->id())->where('run', 's')->get()->toArray();
        foreach ($artS as $art) {
            $articleS[$art['art_name']] = Art::find($art['id'])->outgo()->get(['outgo_name', 'id'])->toArray();
        }
        */
        $artD = Art::whereUserId(auth()->id())->where('run', 'p')->orderBy('art_name')->get()->toArray();
        foreach ($artD as $art) {
            $articleD[$art['id']] = [
                'name' => $art['art_name'],
                'outgo' => Art::find($art['id'])->outgo()->orderBy('outgo_name')->get(['outgo_name', 'id'])->toArray()
            ];
        }
        $artR = Art::whereUserId(auth()->id())->where('run', 'm')->orderBy('art_name')->get()->toArray();
        foreach ($artR as $art) {
            $articleR[$art['id']] = [
                'name' => $art['art_name'],
                'outgo' => Art::find($art['id'])->outgo()->orderBy('outgo_name')->get(['outgo_name', 'id'])->toArray()
            ];
        }
        $article[$this->groupIn] = $articleD;
        $article[$this->groupOut] = $articleR;
//        dd($article);

        return view('art.index', [
            'invoices' => $invoices,
            'article' => $article,
            'artS' => $articleS,
            'artD' => $articleD,
            'artR' => $articleR,
            'artId' => $id

        ]);
    }

    public function crud(Request $request)
    {
        $id = 0;
        if ($request->has('nameArt')) {
            Art::find($request->get('artId'))
                ->update([
                    'art_name' => $request->get('nameArt')
                ]);
            Session::flash('status', "имя раздела: <strong>{$request->get('nameOld')}</strong> успешно изменено на <strong>{$request->get('nameArt')}</strong>");
        }
        if ($request->has('nameOutgo')) {
            Outgo::find($request->get('outgoId'))
                ->update([
                    'outgo_name' => $request->get('nameOutgo')
                ]);
            $id = $request->get('artId');
            Session::flash('status', "название статьи: <strong>{$request->get('nameOld')}</strong> успешно изменено на <strong>{$request->get('nameOutgo')}</strong>");
        }
        if ($request->has('outgo_name')) {
            $rec = $request->only('art_id', 'outgo_name');
            $rec['user_id'] = auth()->id();
            Outgo::create($rec);
            $id = $request->get('art_id');
            Session::flash('status', "Новая статья : <strong>{$request->get('outgo_name')}</strong> успешно создана!");
        }
        if ($request->has('art_name')) {
            Art::create([
                'art_name' => $request->get('art_name'),
                'run' => $this->getRun($request),
                'user_id' => auth()->id()
            ]);
        }
        if ($request->has('delArt')) {
            if ($art = Art::find($request->get('art_id'))) {
                $nameArt = $art->art_name;
                if ($art->main()->first()) {
                    Session::flash('attention', "удалить раздел <strong>{$nameArt}</strong> не возможно, он уже исползуется!  <a href='#' class='alert-link'>список записей с этим разделом</a>");
                } else {
                    if ($art->outgo()->first()) {
                        Session::flash('attention', "удалить раздел <strong>{$nameArt}</strong> не возможно, он не пуст!");
                    } else {
                        Art::destroy($request->get('art_id'));
                        Session::flash('warning', "Раздел <strong>{$nameArt}</strong> удален!!");
                    }
                }
            } else {
                Session::flash('attention', "удаление не возможно элемент не найден!");
            }
        }
        if ($request->has('delOutgo')) {
            if ($art = Outgo::find($request->get('outgo_id'))) {
                $nameArt = $art->outgo_name;
                if ($art->main()->first()) {
                    Session::flash('attention', "удалить статью <strong>{$nameArt}</strong> не возможно, она уже исползуется!  <a href='#' class='alert-link'>список записей с этой статьей</a>");
                } else {
                    Outgo::destroy($request->get('outgo_id'));
                    Session::flash('warning', "Статья <strong>{$nameArt}</strong> удалена!!");
                }
            } else {
                Session::flash('attention', "удаление не возможно элемент не найден!");
            }
            $id = $request->get('artId');
        }
        return redirect()->route('art.show', ['id' => $id]);
    }

    private function getRun(Request $request)
    {
        if ($request->get('run') == $this->groupIn) return 'p';
        if ($request->get('run') == $this->groupOut) return 'm';
    }
}
