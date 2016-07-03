<?php

namespace SIU;

use Illuminate\Database\Eloquent\Model;

class himnos extends Model
{
    protected $table = 'himnos';

    protected $fillable = ['num', 'nombre','himnario'];
}
