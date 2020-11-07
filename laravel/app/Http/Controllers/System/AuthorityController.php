<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Services\System\AuthorityService;

class AuthorityController extends Controller
{
    protected $server;

    public function __construct(AuthorityService $server)
    {
        $this->server = $server;
    }
}
