<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    use HasFactory;
    protected $table = "sys_base_menus";
    protected $primaryKey = "id";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        "id", "created_at", "updated_at", "deleted_at", "menu_level", "parent_id",
        "path", "name", "hidden", "component", "sort", "meta"
    ];

    protected $casts = [
        'meta' => 'array',
        'hidden' => 'boolean',
    ];
}
