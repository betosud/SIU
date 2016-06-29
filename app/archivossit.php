<?php

namespace SIU;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use SIU\lideres;

class archivossit extends Model
{
    use SoftDeletes;
    protected $table = 'archivossit';

    protected $fillable = ['tokenarchivo','id','idsit','nombrearchivo','descripcionarchivo','tipoarchivo','montoarchivo','rutaarchivo','subidopor','validadopor'];

    protected $dates = ['deleted_at'];

    public function getnombrearchivobaseAttribute(){

        $nombre=str_replace('_',' ',$this->nombrearchivo);
        return $nombre;
    }


    public function getValidadonombreAttribute(){

        if($this->validadopor==0) {
            $validadopor = 'No Validado';
        }
        else{
            $validadopor=User::findorfail($this->validadopor);
            $validadopor=$validadopor->name;
        }
        return $validadopor;
    }

    public function getSubidonombreAttribute(){

        if(is_numeric($this->subidopor) && $this->subidopor!=0){
            $validadopor=User::findorfail($this->subidopor);

            $validadopor=$validadopor->name;
        }
        else{
            $validadopor=$this->subidopor;
        }

        return $validadopor;
    }


    public function datossit(){
        return $this->hasOne('SIU\sit','id','idsit');
    }



}
