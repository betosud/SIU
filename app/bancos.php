<?php

namespace SIU;

use Illuminate\Database\Eloquent\Model;

class bancos extends Model
{
    protected $table = 'bancos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','nombre','siglas','rutalogo', 'convenio'];
    
}
