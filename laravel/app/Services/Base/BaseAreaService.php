<?php

namespace App\Services\Base;

use App\Services\Service;
use App\Utils\ResultHelper;
use App\Models\Base\BaseAreaModel;

class BaseAreaService extends Service
{
    use ResultHelper;
    protected $model;

    public function __construct(BaseAreaModel $model)
    {
        $this->model = $model;
    }
}
