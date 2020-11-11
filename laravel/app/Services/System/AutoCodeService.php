<?php

namespace App\Services\System;

use App\Services\Service;
use App\Utils\ResultHelper;
use Symfony\Component\HttpFoundation\Response;

class AutoCodeService extends Service
{
    use ResultHelper;

    /**
     * 自动创建所有文件
     * @param array $data
     * @return ResultHelper
     */
    public function autoCode(array $data)
    {
        // 返回结果
        $result = [Response::HTTP_OK, '批量代码生成成功！', []];
        // 模拟数据
        $data['nameSpace'] = "System";
        $data['name'] = "Test";

        // 文件配置数组
        $autoCodeConfig = [
            [
                'file' => "Controller.php",
                'path' => base_path() . "\\app\\Http\\Controllers\\",
                'name' => "控制器"
            ],
            [
                'file' => "Model.php",
                'path' => base_path() . "\\app\\Models\\",
                'name' => "模型"
            ],
            [
                'file' => "Service.php",
                'path' => base_path() . "\\app\\Services\\",
                'name' => "服务"
            ],
        ];

        // 模板文件路径
        $tmpPath = base_path() . "\\resources\\Template\\";
        // 组合命名空间和文件路径
        $middlePath =  $data['nameSpace'] . "\\" . $data['name'];

        foreach ($autoCodeConfig as $value) {
            // 1.检查文件是否存在
            if (file_exists($value['path'] . $middlePath . $value['file'])) {
                $result[0] = Response::HTTP_INTERNAL_SERVER_ERROR;
                $result[1] = "{$data['nameSpace']}/{$data['name']}{$value['file']}文件已经存在，请检查!";
                break;
            }
        }
        // 异常返回终止继续执行
        if ($result[0] != 200) {
            return $this->failed($result[0], $result[1], $result[2]);
        }
        foreach ($autoCodeConfig as $value) {
            // 2.文件生成处理
            // 2.1获取模板文件内容
            $tmpCtrollerPath = $tmpPath . $value['file'];
            $tmpContent = file_get_contents($tmpCtrollerPath);

            // 2.2替换文件内容
            $newContent = str_replace("{{nameSpace}}", $data['nameSpace'], $tmpContent); # 替换命名空间
            $newContent = str_replace("{{Template}}", $data['name'], $newContent);       # 替换类名
            // model 需要特殊处理

            // 2.3输出文件 
            if (($myFile = fopen($value['path'] . $middlePath . $value['file'], "w+")) === false) {
                return $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, "创建文件失败，请检查权限！");
            }
            fwrite($myFile, $newContent);
            fclose($myFile);
        }
        return $this->success($result[0], $result[1], $result[2]);
    }
}
