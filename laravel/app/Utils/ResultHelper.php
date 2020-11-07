<?php

namespace App\Utils;

trait ResultHelper
{
    /**
     * 成功返回
     * @param int $code
     * @param string $msg
     * @param array|boolean $data
     * @return array
     */
    public  function success(int $code, string $msg, $data = [])
    {
        return [
            'success' => true,
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        ];
    }

    /**
     * 返回表格数据组合
     * @param int $code
     * @param string $msg
     * @param array $data
     * @return array
     */
    public function tableData(int $code, string $msg, $data = [])
    {
        return [
            'success' => true,
            'code' => $code,
            'msg' => $msg,
            'data' => [
                'list' => $data['data'],
                'page' => $data['current_page'],
                'pageSize' => $data['per_page'],
                'total' => $data['total'],
            ],
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
