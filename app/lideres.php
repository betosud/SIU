<?php

namespace SIU;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class lideres extends Model
{
    use SoftDeletes;
    protected $table = 'lideres';

    protected $fillable = ['id','idbarrio','llamamiento','nombre','email','organizacion','phone'];

    protected $dates = ['deleted_at'];

    public function scopeByBarrio($query, $ward){
        $query->where('idbarrio', $ward);
    }


    public function getConLlamamientoAttribute(){
        return $this->nombre.' ('.$this->llamamientonombre.')';
    }

    public function getFirmaAttribute(){
        $llamamiento= catalogos::findorfail($this->llamamiento);
        $organizacion=catalogos::findorfail($this->organizacion);
        $firma=$llamamiento->nombre." (".$organizacion->nombre.")";
        return $firma;
    }
    public function getLlamamientoNombreAttribute(){
        $llamamiento=catalogos::findorfail($this->llamamiento);
        return $llamamiento->nombre;
    }
    public function getOrganizacionNombreAttribute(){
        $organizacion=catalogos::findorfail($this->organizacion);
        return $organizacion->nombre;
    }
    public function nombrellamamiento(){
        return $this->hasOne('SIU\catalogos','id','llamamiento');
    }
    public function nombreorganizacion(){
        return $this->hasOne('SIU\catalogos','id','organizacion');
    }
    public function getVisibleAttribute(){
        if($this->deleted_at ==  null)
            $visible="Activo";
        else
            $visible="Relevado";
        return $visible;
    }
}
