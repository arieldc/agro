<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tbl_newsleter extends Model
{
    protected $table = 'newsleter';
    protected $fillable = [
        'mail'
    ];
    public $timestamps = false;
}
