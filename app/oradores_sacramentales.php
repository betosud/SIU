<?php

namespace SIU;

use Illuminate\Database\Eloquent\Model;

class oradores_sacramentales extends Model
{
    protected $fillable = ['id','idprograma','nombre','tema','grupo'];

    public function scopeByPrograma($query, $barrio){
        $query->where('idprograma', $barrio);
    }
}
