<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nagy\LaravelRating\Traits\Rate\Rateable;

class Transaksi extends Model
{
    use Rateable;
    public $timestamps = false;
    protected  $primaryKey = 'id';

}
