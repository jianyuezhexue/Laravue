<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorityModel extends Model
{
    use HasFactory;
    protected $table = "sys_authorities";
    protected $primaryKey = "authority_id";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        "authority_id", "authority_name", "parent_id"
    ];
}
