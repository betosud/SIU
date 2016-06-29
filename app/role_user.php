<?php

namespace SIU;

use Illuminate\Database\Eloquent\Model;

class role_user extends Model
{
    protected $table = 'role_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','role_id','user_id'];
}
