<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\System\AccessLogService;

class AccessLogController extends Controller
{
    protected $server;

    public function __construct(AccessLogService $server)
    {
        $this->server = $server;
    }
}
