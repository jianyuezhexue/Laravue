<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\System\AutoCodeService;

class AutoCodeController extends Controller
{
    protected $server;

    public function __construct(AutoCodeService $server)
    {
        $this->server = $server;
    }
    public function autoCode(Request $request)
    {
        $data = $request->all();
        $result = $this->server->autoCode($data);
        return response()->json($result);
    }
}
