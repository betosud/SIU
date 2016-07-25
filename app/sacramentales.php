<?php

namespace SIU;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use SIU\oradores_sacramentales;
use SIU\asuntos_sacramentales;
use SIU\anuncios_sacramentales;
use SIU\barrios;

class sacramentales extends Model
{

    protected $dates = ['deleted_at'];

    protected $fillable = ['id','idbarrio','fecha','hora','preside','direccion_programa','direccion_himnos','pianista','himno_inicial','oracion_inicial','himno_sacramental','bendice1','bendice2','reparten','himno_intermedio','himno_final','oracion_final','asistencia','observaciones','user_id'];

    public function scopeByBarrio($query, $barrio){
        $query->where('idbarrio', $barrio);
    }

    public function oradores(){
//        $oradores=oradores_sacramentales::where('idprograma',$this->id)->get();
//        $oradores1=array();
//        $oradores2=array();
//
//        foreach ($oradores as $orador){
//            if($orador->grupo==1){
//                $oradores1[]=$orador;
//            }
//            if($orador->grupo==2){
//                $oradores2[]=$orador;
//            }
//        }
//
//        $oradores_sacramentales=array('grupo1'=>$oradores1,'grupo2'=>$oradores2);

        return $this->hasMany('SIU\oradores_sacramentales','idprograma','id');;
    }


    public function asuntos(){
        return $this->hasMany('SIU\asuntos_sacramentales','idprograma','id');
    }
    public function anuncios(){
        return $this->hasMany('SIU\anuncios_sacramentales','idprograma','id');
    }

    public function barrio(){
        return $this->hasOne('SIU\barrios', 'id', 'idbarrio');
    }
    public function getFechadmaAttribute(){
        $fecha=Carbon::createFromFormat('Y-m-d',$this->fecha);
        return $fecha->format('l d F Y');
    }

    public function getHoraHMAttribute(){
        $horaarray=explode(':',$this->hora);
        $hora= Carbon::createFromTime($horaarray[0],$horaarray[1],$horaarray[2]);
        return $hora->format('g:i a');
    }

    public function getnombrearchivoAttribute(){
        $nombre="Sacramental_".$this->id;
        $nombre=str_replace(' ','_',$nombre);
        return $nombre;
    }

}
