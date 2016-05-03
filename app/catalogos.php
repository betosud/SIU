<?php

namespace SIU;

use Illuminate\Database\Eloquent\Model;

class catalogos extends Model
{
    protected $table = 'catalogos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','nombre','combo'];


    public function scopeByCatalogo($query, $combo){
        $query->where('combo', $combo);
    }
}
