<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Invoice
 *
 * @property int $id
 * @property string $invoice_name
 * @property int $sort
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Main[] $main
 * @property-read int|null $main_count
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereInvoiceName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereUserId($value)
 * @mixin \Eloquent
 */
class Invoice extends Model
{
    protected $fillable = [
        'id',
        'invoice_name',
        'color',
        'user_id',
        'sort'
    ];

    public function user ()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function main()
    {
        return $this->hasMany(\App\Main::class);
    }

    static public function getBalance (int $invoice):int
    {
        $p = Main::whereUserId(auth()->id())->whereYear('d', now()->year)->where(['run' => 1, 'invoice_id' => $invoice])->sum('cash');
        $r = Main::whereUserId(auth()->id())->whereYear('d', now()->year)->where(['run' => 0, 'invoice_id' => $invoice])->sum('cash');
        return $p-$r;
    }
}
