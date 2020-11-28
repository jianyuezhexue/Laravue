<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusArticleModel extends Model
{
    use HasFactory;

    protected $table = "bus_article";
    protected $primaryKey = "id";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = ["id","created_at","updated_at","deleted_at","title","desc","author","content","tag"];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];
}
