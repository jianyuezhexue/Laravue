<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\System\UserRequest;
use App\Services\System\UserService;
use App\Utils\ResultHelper;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use ResultHelper;
    protected $userServer;

    public function __construct(UserService $userServer)
    {
        $this->userServer = $userServer;
    }
    /**
     * 用户注册
     * @param UserRequest $request
     * @return Response
     */
    public function register(UserRequest $request)
    {
        $data = $request->all();
        $data['uuid'] = Uuid::uuid1();
        $result = $this->userServer->register($data);
        return response()->json($result);
    }

    /**
     * 用户登录
     * @param UserRequest $request
     * @return Response
     */
    public function login(UserRequest $request)
    {
        $data = $request->all();
        $result = $this->userServer->login($data);
        return response()->json($result);
    }

    /**
     * 用户登出
     */
    public function loginOut()
    {
        Auth::logout();
        $result = $this->success(Response::HTTP_OK, "登出成功");
        return response()->json($result);
    }

    /**
     * 用户列表
     * @param Request $request
     * @return Response
     */
    public function userList(Request $request)
    {
        $pageInfo = $request->all();
        $result = $this->userServer->userList($pageInfo);
        return response()->json($result);
    }

    /**
     * 用户重置角色
     */
    public function setAuthority(Request $request, $uuid)
    {
        $data = $request->all();
        $result = $this->userServer->setAuthority($uuid, $data);
        return response()->json($result);
    }

    /**
     * 指定ID删除用户
     * @param string $id
     * @return JSON
     */
    public function destroy(string $id)
    {
        $result = $this->userServer->destroy($id);
        return response()->json($result);
    }
}
