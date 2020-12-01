<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nagy\LaravelRating\Traits\Rate\Rateable;


class Esccort extends Model
{
    //
    use SoftDeletes, Rateable;
    protected $fillable = ['salary', 'keahlian', 'name', 'age', 'address', 'gender','phone','photo'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
