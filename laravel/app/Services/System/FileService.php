<?php

namespace App\Services\System;

use App\Services\Service;
use App\Utils\ResultHelper;
use App\Models\System\FileModel;

class FileService extends Service
{
    use ResultHelper;
    protected $model;

    public function __construct(FileModel $model)
    {
        $this->model = $model;
    }
}
