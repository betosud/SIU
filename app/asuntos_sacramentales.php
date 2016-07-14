<?php

namespace SIU;

use Illuminate\Database\Eloquent\Model;

class asuntos_sacramentales extends Model
{
    protected $fillable = ['id','idprograma','descripcion'];

    public function scopeByPrograma($query, $barrio){
        $query->where('idprograma', $barrio);
    }
}
