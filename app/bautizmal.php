<?php

namespace SIU;

use Illuminate\Database\Eloquent\Model;

class bautizmal extends Model
{
    protected $table = 'bautizmales';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['id','idbarrio','fecha','hora','direccion','pianista','himnoinicial','oracion_inicial','testigo1','testigo2','ordenanzapor','actividadesienvenida','himno_final','oracion_final','user_id','bautizmode'];

    public function scopeByBarrio($query, $barrio){
        $query->where('idbarrio', $barrio);
    }
}
