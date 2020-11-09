<?php

namespace App\Services\System;

use App\Services\Service;
use App\Utils\ResultHelper;
use App\Models\System\AccessLogModel;

class AccessLogService extends Service
{
    use ResultHelper;
    protected $model;

    public function __construct(AccessLogModel $model)
    {
        $this->model = $model;
    }
}
