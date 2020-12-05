<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Base\BaseAreaService;

class BaseAreaController extends Controller
{
    protected $server;

    public function __construct(BaseAreaService $server)
    {
        $this->server = $server;
    }
}
