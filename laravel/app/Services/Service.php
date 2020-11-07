<?php

namespace App\Services;

use App\Utils\ResultHelper;
use Symfony\Component\HttpFoundation\Response;

class Service
{
    use ResultHelper;
    protected $model;

    /**
     * 获取所有数据
     * @param array $data
     * @return ResultHelper
     */
    public function all(array $data)
    {
        try {
            $result = $this->model->where($data)->get()->toArray();
            $result = $this->success(Response::HTTP_OK, '获取全部数据成功！', ["menus" => $result]);
        } catch (\Exception $ex) {
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
        }
        return $result;
    }

    /**
     * 获取所有数据
     * @param array $data
     * @return ResultHelper
     */
    public function list(array $data)
    {
        try {
            $result = $this->model->where($data)->get()->toArray();
            $result = $this->success(Response::HTTP_OK, '获取分页数据成功！', ["list" => $result]);
        } catch (\Exception $ex) {
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
        }
        return $result;
    }

    /**
     * 添加数据
     * @param array $data
     * @return ResultHelper
     */
    public function create(array $data)
    {
        try {
            $result = $this->model->fill($data)->save();
            $result = $this->success(Response::HTTP_OK, '添加数据成功！', $result);
        } catch (\Exception $ex) {
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
        }
        return $result;
    }

    /**
     * 指定ID删除数据
     * @param string $id
     * @return ResultHelper
     */
    public function destroy($id)
    {
        try {
            $result = $this->model->destroy($id);
            $result = $this->success(Response::HTTP_OK, '删除数据成功', $result);
        } catch (\Exception $ex) {
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
        }
        return $result;
    }

    /**
     * 指定ID查询数据
     * @param string $id
     * @return ResultHelper
     */
    public function find($id)
    {
        try {
            $result = $this->model->find($id);
            $result = $this->success(Response::HTTP_OK, '查询数据成功', $result);
        } catch (\Exception $ex) {
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
        }
        return $result;
    }

    /**
     * 指定ID更新数据
     */
    public function update($id, $data)
    {
        try {
            $model = $this->model->find($id);
            $result = $model->update($data);
            $result = $this->success(Response::HTTP_OK, '编辑数据成功', $result);
        } catch (\Exception $ex) {
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
        }
        return $result;
    }
}
