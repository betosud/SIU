<?php

namespace SIU;

use Illuminate\Database\Eloquent\Model;

class anuncios_sacramentales extends Model
{
    protected $table = 'anuncios_sacramentales';


    protected $fillable = ['id','idprograma','descripcion'];

    public function scopeByPrograma($query, $barrio){
        $query->where('idprograma', $barrio);
    }
}
