<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseAreaModel extends Model
{
    use HasFactory;

    protected $table = "base_area";
    protected $primaryKey = "id";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = ["id","created_at","updated_at","deleted_at","parent_id","shortname","name","merger_name","level","pinyin","code","zip_code","first","lng","lat"];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];
}
