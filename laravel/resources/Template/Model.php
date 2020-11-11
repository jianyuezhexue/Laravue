<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class {{Template}}Model extends Model
{
    use HasFactory;

    protected $table = "{{table}}";
    protected $primaryKey = "{{primaryKey}}";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = {{columns}};
}
