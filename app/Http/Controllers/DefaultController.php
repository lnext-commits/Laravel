<?php

namespace App\Http\Controllers;

use App\Art;
use App\Invoice;
use App\Outgo;
use Illuminate\Http\Request;
use Illuminate\Database\Seeder;

class DefaultController extends Controller
{
    public function table ()
    {
        Invoice::create([
            'invoice_name' => 'Основной',
            'user_id' =>  auth()->user()->id
        ]);
        $duty = Art::create([
            'art_name' => 'Служебный',
            'run' => 's',
            'user_id' => auth()->user()->id
        ]);
        $yield = Art::create([
            'art_name' => 'Доход',
            'run' => 'p',
            'user_id' => auth()->user()->id
        ]);
        $rate = Art::create([
            'art_name' => 'Расход',
            'run' => 'm',
            'user_id' => auth()->user()->id
        ]);
        Outgo::create([
            'outgo_name' => 'перевод',
            'art_id' => $duty->id,
            'user_id' => auth()->user()->id
        ]);
        Outgo::create([
            'outgo_name' => 'ввод остатка',
            'art_id' => $duty->id,
            'user_id' => auth()->user()->id
        ]);
        Outgo::create([
            'outgo_name' => 'Дополнительные',
            'art_id' => $yield->id,
            'user_id' => auth()->user()->id
        ]);
        Outgo::create([
            'outgo_name' => 'Разные покупки',
            'art_id' => $rate->id,
            'user_id' => auth()->user()->id
        ]);
    }
}
