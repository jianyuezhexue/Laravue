<?php

namespace App\Http\Controllers\{{nameSpace}};

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\{{nameSpace}}\{{Template}}Service;

class {{Template}}Controller extends Controller
{
    protected $server;

    public function __construct({{Template}}Service $server)
    {
        $this->server = $server;
    }
}
