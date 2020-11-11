<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class {{Template}}Model extends Model
{
    use HasFactory;

    protected $table = "TB";
    protected $primaryKey = "id";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    // protected $fillable = [
    //     "id", "created_at", "updated_at", "deleted_at", "name", "url", "tag", "key"
    // ];
}
