<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\System\DictionaryDetailService;

class DictionaryDetailController extends Controller
{
    protected $server;

    public function __construct(DictionaryDetailService $server)
    {
        $this->server = $server;
    }
}
