<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Esccort extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['salary', 'keahlian', 'name', 'age', 'address', 'gender','phone','photo'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
