<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;

class gulModel extends Model
{
    public $table="gul";

    public $timestamps=false;

    protected $fillable =
    [
    	'name', 'last_name', 'password',
    ];
}
