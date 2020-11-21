<?php

namespace App\Services\System;

use App\Services\Service;
use App\Utils\ResultHelper;
use App\Models\System\DictionaryDetailModel;

class DictionaryDetailService extends Service
{
    use ResultHelper;
    protected $model;
    protected $sort = ['sort', 'asc'];

    public function __construct(DictionaryDetailModel $model)
    {
        $this->model = $model;
    }
}
