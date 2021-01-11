<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Main
 *
 * @property int $id
 * @property int $invoice_id
 * @property int $art_id
 * @property int $outgo_id
 * @property int $cash
 * @property int $run
 * @property string $d
 * @property string $comment
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Art $art
 * @property-read \App\Invoice $invoice
 * @property-read \App\Outgo $outgo
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Main newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Main newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Main query()
 * @method static \Illuminate\Database\Eloquent\Builder|Main whereArtId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Main whereCash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Main whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Main whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Main whereD($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Main whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Main whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Main whereOutgoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Main whereRun($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Main whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Main whereUserId($value)
 * @mixin \Eloquent
 */
class Main extends Model
{
    protected $table = 'main';
    protected $fillable = [
        'id',
        'invoice_id',
        'art_id',
        'outgo_id',
        'cash',
        'run',
        'd',
        'comment',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function invoice()
    {
        return $this->belongsTo(\App\Invoice::class);
    }

    public function art()
    {
        return $this->belongsTo(\App\Art::class);
    }

    public function outgo()
    {
        return $this->belongsTo(\App\Outgo::class);
    }
}
