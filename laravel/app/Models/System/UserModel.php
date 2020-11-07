<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserModel extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    protected $table = "sys_users";
    protected $primaryKey = "id";
    protected $hidden = ['password'];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        "id", "uuid", "username", "password", "nick_name", "header_img", "authority_id", "created_at", "updated_at"
    ];

    protected function setPasswordAttribute($value)
    {
        $this->attributes['password'] = md5($value);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // 关联角色表
    public function authority()
    {
        return $this->hasOne('App\Models\System\AuthorityModel','authority_id','authority_id');
    }
}
