<?php

namespace SIU;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class cumples extends Model
{
    protected $table = 'cumples';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['id','idbarrio','nombre','fecha'];

    public function scopeByBarrio($query, $barrio){
        $query->where('idbarrio', $barrio);
    }

    public function getEdadAttribute(){
//        dd(substr($this->fecha,0,4));
        $edad= Carbon::createFromDate(substr($this->fecha,0,4),substr($this->fecha,5,2),substr($this->fecha,8,2))->age;
        return $edad;
    }
    public function getFechaCumpleAttribute(){
//        dd(substr($this->fecha,0,4));
        $fecha= Carbon::createFromDate(substr($this->fecha,0,4),substr($this->fecha,5,2),substr($this->fecha,8,2));

        return $fecha->format('d F');
    }
}
