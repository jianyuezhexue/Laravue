<?php

namespace App\Services\System;

use App\Utils\ResultHelper;
use App\Models\System\UserModel;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserService
{
    use ResultHelper;
    protected $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * 用户注册
     * @param $data
     * @return Response
     */
    public function register($data)
    {
        try {
            // 1.username查重
            $check = $this->userModel->where(['username' => $data['username']])->first();
            if ($check) {
                return $this->failed(Response::HTTP_BAD_REQUEST, "用户名重复，请更换", []);
            }
            // 2.保存数据
            $result = $this->userModel->fill($data)->save();
            $result = $this->success(Response::HTTP_OK, '数据保存成功', $this->userModel);
        } catch (\Exception $ex) {
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
        }
        return $result;
    }

    /**
     * 用户登录
     * @param array $data
     * @return array $result
     */
    public function login(array $data)
    {
        try {
            // 1.查找用户
            $result = $this->userModel->where(['username' => $data['username']])->first();
            // 2.校验密码
            if (md5($data['password']) != $result->password) {
                return $this->failed(Response::HTTP_BAD_REQUEST, "账户或密码不正确！", []);
            }
            // 3.签发token
            $result->token = Auth::login($result);
            $result = $this->success(Response::HTTP_OK, '登录成功', $result);
        } catch (\Exception $ex) {
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
        }
        return $result;
    }

    /**
     * 用户列表
     * @param array $pageInfo
     * @return Response
     */
    public function userList($pageInfo)
    {
        try {
            $result = $this->userModel->with('authority')->paginate($pageInfo['pageSize'])->toArray();
            $result = $this->tableData(Response::HTTP_OK, '获取成功', $result);
        } catch (\Exception $ex) {
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
        }
        return $result;
    }

    /**
     * 用户重置juese
     * @param string $uuid
     * @param array $data
     * @return Response
     */
    public function setAuthority($uuid, $data)
    {
        try {
            $result = $this->userModel->where('uuid', $uuid)->update($data);
            $result = $this->success(Response::HTTP_OK, '重置角色成功', $result);
        } catch (\Exception $ex) {
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
        }
        return $result;
    }

    /**
     * 指定ID删除用户
     * @param string $id
     * @return ResultHelper
     */
    public function destroy($id)
    {
        try {
            $result = $this->userModel->destroy($id);
            $result = $this->success(Response::HTTP_OK, '删除用户成功', $result);
        } catch (\Exception $ex) {
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
        }
        return $result;
    }
}
