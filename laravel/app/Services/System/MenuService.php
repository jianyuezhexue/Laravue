<?php

namespace App\Services\System;

use App\Utils\Tree;
use App\Utils\ResultHelper;
use App\Models\System\MenuModel;
use Symfony\Component\HttpFoundation\Response;


class MenuService
{
    use ResultHelper;
    protected $menuModel;

    public function __construct(MenuModel $menuModel)
    {
        $this->menuModel = $menuModel;
    }

    /**
     * 获取所有菜单
     * @param array $data
     * @return ResultHelper
     */
    public function all(array $data)
    {
        try {
            $result = $this->menuModel->where($data)->orderBy('sort')->get()->toArray();
            $result = Tree::makeTree($result);
            $result = $this->success(Response::HTTP_OK, '获取全部数据成功！', ["menus" => $result]);
        } catch (\Exception $ex) {
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
        }
        return $result;
    }

    /**
     * 获取所有菜单
     * @param array $data
     * @return ResultHelper
     */
    public function list(array $data)
    {
        try {
            $result = $this->menuModel->where($data)->orderBy('sort')->get()->toArray();
            $result = Tree::makeTree($result);
            $result = $this->success(Response::HTTP_OK, '获取分页数据成功！', ["list" => $result]);
        } catch (\Exception $ex) {
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
        }
        return $result;
    }

    /**
     * 添加菜单
     * @param array $data
     * @return ResultHelper
     */
    public function create(array $data)
    {
        try {
            $result = $this->menuModel->fill($data)->save();
            $result = $this->success(Response::HTTP_OK, '添加菜单成功！', $result);
        } catch (\Exception $ex) {
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
        }
        return $result;
    }

    /**
     * 指定ID删除菜单
     * @param string $id
     * @return ResultHelper
     */
    public function destroy($id)
    {
        try {
            $result = $this->menuModel->destroy($id);
            $result = $this->success(Response::HTTP_OK, '删除菜单成功', $result);
        } catch (\Exception $ex) {
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
        }
        return $result;
    }

    /**
     * 指定ID查询菜单
     * @param string $id
     * @return ResultHelper
     */
    public function find($id)
    {
        try {
            $result = $this->menuModel->find($id);
            $result = $this->success(Response::HTTP_OK, '查询菜单成功', $result);
        } catch (\Exception $ex) {
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
        }
        return $result;
    }

    /**
     * 指定ID更新菜单
     */
    public function update($id, $data)
    {
        try {
            $model = $this->menuModel->find($id);
            $result = $model->update($data);
            $result = $this->success(Response::HTTP_OK, '编辑菜单成功', $result);
        } catch (\Exception $ex) {
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
        }
        return $result;
    }
}
