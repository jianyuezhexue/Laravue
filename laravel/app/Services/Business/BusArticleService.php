<?php

namespace App\Services\Business;

use App\Services\Service;
use App\Utils\ResultHelper;
use App\Models\Business\BusArticleModel;

class BusArticleService extends Service
{
    use ResultHelper;
    protected $model;

    public function __construct(BusArticleModel $model)
    {
        $this->model = $model;
    }
}
