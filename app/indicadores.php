<?php

namespace SIU;

use Illuminate\Database\Eloquent\Model;

class indicadores extends Model
{
    protected $table = 'indicadores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','nombre','descripcion','opciones'];
}
