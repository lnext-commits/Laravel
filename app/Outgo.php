<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Outgo
 *
 * @property int $id
 * @property string $outgo_name
 * @property int $art_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Art $art
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Main[] $main
 * @property-read int|null $main_count
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Outgo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Outgo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Outgo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Outgo whereArtId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Outgo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Outgo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Outgo whereOutgoName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Outgo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Outgo whereUserId($value)
 * @mixin \Eloquent
 */
class Outgo extends Model
{
    protected $table = 'outgo';

    protected $fillable =[
        'id',
        'outgo_name',
        'art_id',
        'user_id'
    ];

    public function user ()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function main()
    {
        return $this->hasMany(\App\Main::class);
    }
    public function art ()
    {
        return $this->belongsTo(\App\Art::class);
    }
}
