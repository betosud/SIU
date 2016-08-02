<?php

namespace SIU;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sit extends Model
{
    use SoftDeletes;
    protected $table = 'sit';

    protected $fillable = ['fechasit','tipopago','idestaca','id','idbarrio','idsit','fecha','solicitante','mail','pagable','ife','descripcion','pagable','cantidad','organizaciongasto','categoria','obispo','pteorganizacion','observaciones','status','statuscomprobantes','enviado','user_id','token'];

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

    public function datosbarrio(){
        return $this->hasOne('SIU\barrios', 'id', 'idbarrio');

    }
    public function getOrganizacionNombreAttribute(){
        $organizacion= catalogos::findorfail($this->organizaciongasto);
        return $organizacion->nombre;
    }

    public function gettipopagodscAttribute(){
        $tipopago= catalogos::findorfail($this->tipopago);
        return $tipopago->nombre;
    }

    public function getstatusnombreAttribute(){
        $status= catalogos::findorfail($this->status);
        return $status->nombre;
    }

    public function getNombreArchivoAttribute(){
        $fecha= Carbon::createFromFormat('Y-m-d',$this->fechasit);
        $nombre="Sit_".$this->id."_".$this->idbarrio."_".$fecha->format('Y_m_d').".pdf";
        return $nombre;
    }
    public function getCategoriaNombreAttribute(){
        $catalogo=catalogos::findorfail($this->categoria);
        return $catalogo->nombre;
    }
    public function getPteorganizacionNombreAttribute(){
        $catalogo=lideres::withTrashed()->where('id',$this->pteorganizacion)->first();

        return $catalogo->nombre;
    }
    public function getObispoNombreAttribute(){
        $catalogo=lideres::findorfail($this->obispo);
        return $catalogo->nombre;
    }
    public function getFechadmaAttribute(){
        $fecha=Carbon::createFromFormat('Y-m-d',$this->fecha);
        return $fecha->format('l d F Y');
    }
    public function getFechasitdmaAttribute(){
        $fecha=Carbon::createFromFormat('Y-m-d',$this->fechasit);
        return $fecha->format('l d F Y');
    }
}
