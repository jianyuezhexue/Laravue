<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DictionaryModel extends Model
{
    use HasFactory;
    protected $table = "sys_dictionaries";
    protected $primaryKey = "id";

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        "id", "created_at", "updated_at", "deleted_at", "name", "type",
        "status", "desc"
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'status' => 'boolean',
    ];

    // 关联子表
    public function sysDictionaryDetails()
    {
        return $this->hasMany('App\Models\System\DictionaryDetailModel','sys_dictionary_id','id');
    }
}
