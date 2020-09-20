<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lansia extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $fillable = ['nama','umur','gender','hobi','riwayat'];
}
