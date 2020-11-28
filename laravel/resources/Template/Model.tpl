<?php

namespace App\Models\{{nameSpace}};

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

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];
}
