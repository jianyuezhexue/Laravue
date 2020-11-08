<?php

namespace App\Services\System;

use App\Services\Service;
use App\Utils\ResultHelper;
use App\Models\System\DictionaryModel;

class DictionaryService extends Service
{
    use ResultHelper;
    protected $model;

    // 模糊查询
    protected $likeSearch = "desc";

    public function __construct(DictionaryModel $model)
    {
        $this->model = $model;
    }
}
