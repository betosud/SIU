<?php

namespace SIU;

use Illuminate\Database\Eloquent\Model;

class barrios extends Model
{

    protected $fillable = ['id','idestaca','nombreunidad','email', 'passwemail', 'nombrecalendario','apicalendario','idbanco'];
    public function scopeByEstaca($query, $idestaca){
        $query->where('idestaca', $idestaca);
    }

    public function datosbanco(){
        return $this->hasOne('SIU\bancos', 'id', 'idbanco');
    }
}
