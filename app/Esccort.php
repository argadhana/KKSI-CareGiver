<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Esccort extends Model
{
    //
    protected $filable = ['salary', 'keahlian', 'name', 'age', 'address', 'gender','phone','photo'];
    public $timestamps = false;
}
