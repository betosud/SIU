<?php

namespace SIU;

use Illuminate\Database\Eloquent\Model;

class indicadoresbarrios extends Model
{
    protected $table = 'indicadoresbarrios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','idbarrio','idindicador','tipo','valor','user_id'];


    public function scopeIndicadoresBarrio($query, $idbarrio,$tipo,$indicadorid){
        $query->where('idbarrio', $idbarrio)
            ->where('tipo',$tipo)
            ->where('idindicador',$indicadorid);
    }
}
