<?php

namespace SIU;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class archivossit extends Model
{
    use SoftDeletes;
    protected $table = 'archivossit';

    protected $fillable = ['id','idsolicitud','nombre','descripcion','tipo','monto','rutaarchivo','user_id'];

    protected $dates = ['deleted_at'];

    public function getnombrearchivoAttribute(){

        $nombre=str_replace('_',' ',$this->nombre);
        return $nombre;
    }



}
    