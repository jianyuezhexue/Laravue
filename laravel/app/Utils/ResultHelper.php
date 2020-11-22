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
        /** 方案一 */
        //使用file_exists判断文件是否存
        ob_end_clean();
        ob_start();
        //打开文件
        $handler            = fopen($file_dir, 'r+b');
        $file_size          = filesize($file_dir);
        //声明头信息
        Header("Content-type: application/octet-stream");
        Header("Accept-Ranges: bytes");
        Header("Accept-Length: " . $file_size);
        Header("Content-Disposition: attachment; filename=" . basename($file_dir));
        // 输出文件内容
        echo fread($handler, $file_size);
        fclose($handler);
        ob_end_flush();
        exit;

        /** 方案二 */
        //  //这里是下载zip文件
        //  header("Content-Type: application/zip");
        //  header("Content-Transfer-Encoding: Binary");

        //  header("Content-Length: " . filesize($file_dir));
        //  header("Content-Disposition: attachment; filename=\"" . basename($file_dir) . "\"");

        //  readfile($file_dir);
        //  exit;


        /** 方案三 */

        // 刷新缓冲区
        // ob_end_clean();
        // ob_start();

        // //以只读和二进制模式打开文件   
        // $file = fopen($file_dir, "rb");
        // $file_name = basename($file_dir);

        // //告诉浏览器这是一个文件流格式的文件    
        // Header("Content-type: application/octet-stream");
        // //请求范围的度量单位  
        // Header("Accept-Ranges: bytes");
        // //Content-Length是指定包含于请求或响应中数据的字节长度    
        // Header("Accept-Length: " . filesize($file_dir));
        // //用来告诉浏览器，文件是可以当做附件被下载，下载后的文件名称为$file_name该变量的值。
        // Header("Content-Disposition: attachment; filename=" . $file_name);

        // //读取文件内容并直接输出到浏览器    
        // echo fread($file, filesize($file_dir));
        // fclose($file);
        // exit();
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
