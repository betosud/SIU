<?php

namespace SIU;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sit extends Model
{
    use SoftDeletes;
    protected $table = 'sit';

    protected $fillable = ['id','idsolicitud','fecha','categoria','pteorganizacion','obispo','status','statuscomprobantes','enviooficinas','user_id','beneficiario'];

    protected $dates = ['deleted_at'];
    public function getFechadmaAttribute(){
        $fecha=Carbon::createFromFormat('Y-m-d',$this->fecha);
        return $fecha->format('l d F Y');
    }



    public function getOrganizacionNombreAttribute(){
        $catalogo=catalogos::findorfail($this->organizacion)->withTrashed()->get();
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



    public function getCategoriaNombreAttribute(){
        $catalogo=catalogos::findorfail($this->categoria);
        return $catalogo->nombre;
    }
    public function getComprobantesdscAttribute(){
        $catalogo=catalogos::findorfail($this->statuscomprobantes);
        return $catalogo->nombre;
    }
    public function getStatusdscAttribute(){
        $catalogo=catalogos::findorfail($this->status);
        return $catalogo->nombre;
    }
}
