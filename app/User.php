<?php

namespace SIU;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;


use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, CanResetPassword,HasRoleAndPermission,SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','idestaca','idbarrio','name', 'email', 'password','llamamiento'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];



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
