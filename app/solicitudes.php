<?php

namespace SIU;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class solicitudes extends Model
{
    use SoftDeletes;
    protected $table = 'solicitudes';

    protected $fillable = ['id','idestaca','idbarrio','fecha','solicitante','mail','pagable','ife','descripcion','cantidad','organizacion','tipopago','observaciones','status','pteorganizacion','obispo'];

    protected $dates = ['deleted_at'];


    public function scopeNuevas($query, $status,$idbarrio){
        $query->where('status', $status)->where('idbarrio',$idbarrio);
    }

    public function scopeByBarrio($query, $barrio){
        $query->where('idbarrio', $barrio);
    }

    public function scopeByestaca($query, $estaca){
        $query->where('idestaca', $estaca);
    }
    public function scopeByorganizacion($query, $organizacion){
        $query->where('idestaca', $organizacion);
    }

    public function getTipoPagoNombreAttribute(){
        $tipopago= catalogos::findorfail($this->tipopago);
        return $tipopago->nombre;
    }


    public function datossit(){
        return $this->hasOne('SIU\sit', 'idsolicitud', 'id');
    }



    public function getOrganizacionNombreAttribute(){
        $organizacion= catalogos::findorfail($this->organizacion);
        return $organizacion->nombre;
    }

    public function getstatusnombreAttribute(){
        $status= catalogos::findorfail($this->status);
        return $status->nombre;
    }

    public function getfechamdaAttribute(){
        $fecha= Carbon::createFromFormat('Y-m-d',$this->fecha);
        return $fecha->format('l d F Y');
    }

    public function gettipopagodscAttribute(){
        $tipopago= catalogos::findorfail($this->tipopago);
        return $tipopago->nombre;
    }

    public function getNombreArchivoAttribute(){
        $fecha= Carbon::createFromFormat('Y-m-d',$this->fecha);
        $nombre="Sit_".$this->id."_".$this->idbarrio."_".$fecha->format('Y_m_d').".pdf";
        return $nombre;
    }

    public function datosbarrio(){
        return $this->hasOne('SIU\barrios', 'id', 'idbarrio');
    }

}
