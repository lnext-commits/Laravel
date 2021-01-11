<?php

use App\Art;
use App\Invoice;
use App\Outgo;
use App\User;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uzer = User::create([
            'name' => 'Динис ',
            'surname' => 'Андрюхин',
            'login' => 'deny',
            'password' => '115599'
        ]);

        Invoice::create([
            'invoice_name' => 'Основной',
            'user_id' => $uzer->id
        ]);
        $duty = Art::create([
            'id' => 1,
            'art_name' => 'Служебный',
            'run' => 's',
            'user_id' => $uzer->id
        ]);
        $yield = Art::create([
            'id' => 10,
            'art_name' => 'Доход',
            'run' => 'p',
            'user_id' => $uzer->id
        ]);
        $rate = Art::create([
            'id' => 11,
            'art_name' => 'Расход',
            'run' => 'm',
            'user_id' => $uzer->id
        ]);
        Outgo::create([
            'outgo_name' => 'перевод',
            'art_id' => $duty->id,
            'user_id' => $uzer->id
        ]);
        Outgo::create([
            'outgo_name' => 'ввод остатка',
            'art_id' => $duty->id,
            'user_id' => $uzer->id
        ]);
        Outgo::create([
            'outgo_name' => 'Дополнительные',
            'art_id' => $yield->id,
            'user_id' => $uzer->id
        ]);
        Outgo::create([
            'outgo_name' => 'Разные покупки',
            'art_id' => $rate->id,
            'user_id' => $uzer->id
        ]);

    }
}
