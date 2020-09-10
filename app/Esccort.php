<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Esccort extends Model
{
    //
    protected $guarded = ['id'];
    protected $filable = ['salary', 'keahlian', 'name', 'age', 'address', 'gender','phone', 'rating','photo'];
    public $timestamps = false;
}
