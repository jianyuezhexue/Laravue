<?php

namespace App\Utils;

trait ResultHelper
{
    /**
     * 成功返回
     * @param string $code
     * @param string $msg
     * @param array $data
     * @return array
     */
    public  function success($code, $msg, $data = [])
    {
        return [
            'success' => true,
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        ];
    }

    /**
     * 失败返回
     * @param string $code
     * @param string $msg
     * @param array $data
     * @return array
     */
    public  function failed($code, $msg, $data = [])
    {
        return [
            'success' => false,
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        ];
    }
}
