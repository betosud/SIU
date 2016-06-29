<?php

namespace SIU;

use Illuminate\Database\Eloquent\Model;

class estacas extends Model
{
    protected $table = 'estacas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','nombre','email','password'];
}
