<?php

namespace SIU;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use SIU\barrios;




class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','idestaca','idbarrio','name', 'email', 'password','llamamiento'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $dates = ['deleted_at'];

    public function datos(){
        return $this->hasOne('SIU\barrios','id','idbarrio');
    }

    public function getbarrionombreAttribute(){
        $barrio=$this->hasOne('SIU\barrios','id','idbarrio')->get();
        return $barrio[0]->nombreunidad;
    }

    public function getRolnameAttribute(){
        $roluser=role_user::where('user_id',$this->id)->get();

        $rol=roles::where('id',$roluser[0]->role_id)->get();
        $name=$rol[0]->name;
        return $name;
    }
    public function getRolidAttribute(){
        $roluser=role_user::where('user_id',$this->id)->get();

        $rol=roles::where('id',$roluser[0]->role_id)->get();
        $id=$rol[0]->id;
        return $id;
    }

    public function setPasswordAttribute($value){
        if(!empty($value)) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    public function getStatusAttribute(){
        $status="Incativo";
        if($this->attributes['deleted_at']==null) {
            $status="Activo";
            return $status;

        }
        return $status;
    }



}
