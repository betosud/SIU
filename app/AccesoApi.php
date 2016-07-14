<?php

namespace SIU;

use Illuminate\Database\Eloquent\Model;

class AccesoApi extends Model
{
    protected $table = 'apisiu';
    protected $fillable = ['id','user','apikey'];
}
