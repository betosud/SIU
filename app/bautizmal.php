<?php

namespace SIU;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class bautizmal extends Model
{
    protected $table = 'bautizmales';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['id','idbarrio','fecha','hora','asistencia','dirigidopor','direccion_himnos','pianista','himno_inicial','oracion_inicial','testigo1','testigo2','ordenanzapor','actividades','bienvenida','himno_final','oracion_final','user_id','bautizmode'];

    public function scopeByBarrio($query, $barrio){
        $query->where('idbarrio', $barrio);
    }



    public function getFechadmaAttribute(){
        $fecha= Carbon::createFromFormat('Y-m-d',$this->fecha);
        return $fecha->format('l d F Y');
    }

    public function getHoraHMAttribute(){
        $horaarray=explode(':',$this->hora);
        $hora=Carbon::createFromTime($horaarray[0],$horaarray[1],$horaarray[2]);
        return $hora->format('g:i a');

    }
}
