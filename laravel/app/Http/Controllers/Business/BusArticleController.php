<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Business\BusArticleService;

class BusArticleController extends Controller
{
    protected $server;

    public function __construct(BusArticleService $server)
    {
        $this->server = $server;
    }
}
