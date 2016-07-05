<?php

namespace SIU;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class oradores_bautizmal extends Model
{
//    use SoftDeletes;
    protected $table = 'oradores_bautizmales';

    protected $fillable = ['id','idprograma','nombre','tema'];

//    protected $dates = ['deleted_at'];
    
}
