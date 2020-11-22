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
                'page' => (int)$data['current_page'],
                'pageSize' => (int)$data['per_page'],
                'total' => (int)$data['total'],
            ],
        ];
    }

    /**
     * 读取文件，返回二进制流
     * @param string $file_dir
     * @return void
     */
    public function blobData(string $file_dir)
    {
        // 清除缓冲区
        ob_end_clean();
        ob_start();

        // 打开文件
        $handler            = fopen($file_dir, 'r+b');
        $file_size          = filesize($file_dir);

        // 声明头信息
        header("success: true");  // 关闭前端响应拦截
        Header("Content-type: application/octet-stream");
        Header("Accept-Ranges: bytes");
        Header("Accept-Length: " . $file_size);
        Header("Content-Disposition: attachment; filename=" . basename($file_dir));
        
        // 输出文件内容
        echo fread($handler, $file_size);
        fclose($handler);
        ob_end_flush();
        exit;
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
