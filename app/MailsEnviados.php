<?php

namespace SIU;

use Illuminate\Database\Eloquent\Model;

class MailsEnviados extends Model
{
    protected $table = 'mailsenviados';

    protected $fillable = ['idbarrio', 'to','for','name','subjet'];
}
