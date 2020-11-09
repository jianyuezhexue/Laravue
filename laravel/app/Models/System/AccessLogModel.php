<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessLogModel extends Model
{
    use HasFactory;

    protected $table = 'sys_access_log';
    protected $primaryKey = "id";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        "id", "created_at", "updated_at", "deleted_at", "ip", "method", "path", "status",
        "latency", "agent", "error_message", "body", "resp", "user_id", "user_name"
    ];

    protected $casts = [
        'resp' => 'array',
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];
}
