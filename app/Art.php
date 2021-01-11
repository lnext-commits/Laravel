<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Art
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Main[] $main
 * @property-read int|null $main_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Outgo[] $outgo
 * @property-read int|null $outgo_count
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Art newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Art newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Art query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $art_name
 * @property string $run
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Art whereArtName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Art whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Art whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Art whereRun($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Art whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Art whereUserId($value)
 */
class Art extends Model
{
//    protected $table = 'arts';

    protected $fillable =[
        'id',
        'art_name',
        'run',
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

    public function outgo()
    {
        return $this->hasMany(\App\Outgo::class);
    }
}
