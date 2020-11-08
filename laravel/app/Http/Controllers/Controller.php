<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 公共方法
     */
    protected $server;

    /**
     * 获取所有数据
     * @param Request $request
     * @return JSON
     */
    public function all(Request $request)
    {
        $data = $request->all();
        $result = $this->server->all($data);
        return response()->json($result);
    }

    /**
     * 获取所有分页数据
     * @param Request $request
     * @return JSON
     */
    public function list(Request $request)
    {
        // 对请求数据进行分流
        $params = $request->all();
        $this->pageInfo['page'] = $params['page'];
        $this->pageInfo['pageSize'] = $params['pageSize'];
        unset($params['page']);
        unset($params['pageSize']);
        $this->searchInfo = $params;
        $result = $this->server->list($this->pageInfo, $this->searchInfo);
        return response()->json($result);
    }

    /**
     * 增加
     * @param Request $request
     * @return JSON
     */
    public function create(Request $request)
    {
        $data = $request->all();
        $result = $this->server->create($data);
        return response()->json($result);
    }

    /**
     * 指定ID删除
     * @param string $id
     * @return JSON
     */
    public function destroy(string $id)
    {
        $result = $this->server->destroy($id);
        return response()->json($result);
    }

    /**
     * 指定ID查找
     * @param string $id
     * @return JSON
     */
    public function find(string $id)
    {
        $result = $this->server->find($id);
        return response()->json($result);
    }

    /**
     * 指定ID更新
     * @param string $id
     * @param array $data
     * @return JSON
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $result = $this->server->update($id, $data);
        return response()->json($result);
    }
}
