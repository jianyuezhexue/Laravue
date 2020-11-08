<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\System\FileService;

class FileController extends Controller
{
    protected $server;

    public function __construct(FileService $server)
    {
        $this->server = $server;
    }
}
