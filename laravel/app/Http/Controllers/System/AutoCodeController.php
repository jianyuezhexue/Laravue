<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\AutoCodeRequest;
use Illuminate\Http\Request;
use App\Services\System\AutoCodeService;

class AutoCodeController extends Controller
{
    protected $server;

    public function __construct(AutoCodeService $server)
    {
        $this->server = $server;
    }

    /**
     * 自动生成所有代码
     * @param AutoCodeRequest $request
     * @return Response
     */
    // TODO:测试完改回来
    public function autoCode(AutoCodeRequest $request)
    // public function autoCode(Request $request)
    {
        $data = $request->all();
        // TODO:测试完改回来
        $result = $this->server->autoCode($data);
        // $result = $this->server->autoCodeNew($data);
        return response()->json($result);
    }

    /**
     * 获取所有DB
     * @return Response
     */
    public function getDB()
    {
        $result = $this->server->getDB();
        return response()->json($result);
    }

    /**
     * 获取所有Tables
     * @return Response
     */
    public function getTables(AutoCodeRequest $request)
    {
        $data = $request->all();
        $result = $this->server->getTables($data['dbName']);
        return response()->json($result);
    }

    /**
     * 获取所有Colume
     * @return Response
     */
    public function getColume(AutoCodeRequest $request)
    {
        $data = $request->all();
        $result = $this->server->getColume($data);
        return response()->json($result);
    }
}
