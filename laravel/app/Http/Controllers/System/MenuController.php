<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\System\MenuService;

class MenuController extends Controller
{
    protected $menuServer;

    public function __construct(MenuService $menuServer)
    {
        $this->menuServer = $menuServer;
    }

    /**
     * 获取所有菜单数据
     * @param Request $request
     * @return JSON
     */
    public function all(Request $request)
    {
        $data = $request->all();
        $result = $this->menuServer->all($data);
        return response()->json($result);
    }

    /**
     * 获取所有菜单数据
     * @param Request $request
     * @return JSON
     */
    public function async(Request $request)
    {
        $data = $request->all();
        $result = $this->menuServer->async($data);
        return response()->json($result);
    }

    /**
     * 获取所有菜单分页数据
     * @param Request $request
     * @return JSON
     */
    public function list(Request $request)
    {
        $data = $request->all();
        $result = $this->menuServer->list($data);
        return response()->json($result);
    }

    /**
     * 增加菜单
     * @param Request $request
     * @return JSON
     */
    public function create(Request $request)
    {
        $data = $request->all();
        $result = $this->menuServer->create($data);
        return response()->json($result);
    }

    /**
     * 指定ID删除菜单
     * @param string $id
     * @return JSON
     */
    public function destroy(string $id)
    {
        $result = $this->menuServer->destroy($id);
        return response()->json($result);
    }

    /**
     * 指定ID查找菜单
     * @param string $id
     * @return JSON
     */
    public function find(string $id)
    {
        $result = $this->menuServer->find($id);
        return response()->json($result);
    }

    /**
     * 更新菜单
     * @param string $id
     * @param array $data
     * @return JSON
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $result = $this->menuServer->update($id, $data);
        return response()->json($result);
    }
}
