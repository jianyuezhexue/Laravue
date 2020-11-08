<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\System\DictionaryService;

class DictionaryController extends Controller
{
    protected $server;

    public function __construct(DictionaryService $server)
    {
        $this->server = $server;
    }
}
