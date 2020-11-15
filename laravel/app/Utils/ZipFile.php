<?php

namespace App\Utils;

use App\Utils\ResultHelper;
use Symfony\Component\HttpFoundation\Response;

trait ZipFile
{
    use ResultHelper;
    /**
     * 打包文件夹为 ZIP
     * @param string $path
     * @param string $filename
     * @return string $filename
     */
    function addFileToZip($path, $filename)
    {
        try {
            /** 1.获取文件列表 */
            $datalist = $this->list_dir($path);

            /** 2.生成压缩包文件 */
            $zip = new \ZipArchive();
            if ($zip->open($filename, \ZipArchive::CREATE) !== TRUE) {
                return $this->failed(Response::HTTP_VERSION_NOT_SUPPORTED, "无法打开文件，或者文件创建失败");
            }

            /** 3.添加文件到压缩包 */
            foreach ($datalist as $val) {
                if (file_exists($val)) {
                    $zip->addFile($val, basename($val)); //第二个参数是放在压缩包中的文件名称，如果文件可能会有重复，就需要注意一下 
                }
            }
            $zip->close(); //关闭 
            $result = $this->$this->success(Response::HTTP_OK, "压缩文件夹成功！", $filename);
        } catch (\Exception $ex) {
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
        }
        return $result;
    }

    /**
     * 根据目录获取文件列表
     * @param string $dir
     * @return array $result
     */
    function list_dir($dir)
    {
        $result = array();
        if (is_dir($dir)) {
            $file_dir = scandir($dir);
            foreach ($file_dir as $file) {
                if ($file == '.' || $file == '..') {
                    continue;
                } elseif (is_dir($dir . $file)) {
                    $result = array_merge($result, $this->list_dir($dir . $file . '/'));
                } else {
                    array_push($result, $dir . $file);
                }
            }
        }
        return $result;
    }
}
