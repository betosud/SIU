<?php

namespace SIU;

use Illuminate\Database\Eloquent\Model;
use SIU\oradores_sacramentales;
use SIU\asuntos_sacramentales;
use SIU\anuncios_sacramentales;

class sacramentales extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['id','idbarrio','fecha','hora','preside','direccion_programa','direccion_himnos','pianista','himno_inicial','oracion_inicial','himno_sacramental','bendice1','bendice2','reparten','himno_intermedio','himno_final','oracion_final','asistencia','observaciones','user_id'];

    public function scopeByBarrio($query, $barrio){
        $query->where('idbarrio', $barrio);
    }

    public function oradores(){
        return $this->hasOne('SIU\oradores_sacramentales','idprograma','id');
    }
    public function asuntos(){
        return $this->hasOne('SIU\asuntos_sacramentales','idprograma','id');
    }
    public function anuncios(){
        return $this->hasOne('SIU\anuncios','idprograma','id');
    }

}
