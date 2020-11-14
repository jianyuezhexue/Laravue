<?php

namespace App\Services\System;

use App\Services\Service;
use App\Utils\ResultHelper;
use Illuminate\Support\Facades\DB;
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
        // 文件配置数组
        $autoCodeConfig = [
            [
                'type' => "Controller",
                'file' => "Controller.php",
                'path' => base_path() . "\\app\\Http\\Controllers\\",
                'name' => "控制器"
            ],
            [
                'type' => "Model",
                'file' => "Model.php",
                'path' => base_path() . "\\app\\Models\\",
                'name' => "模型"
            ],
            [
                'type' => "Service",
                'file' => "Service.php",
                'path' => base_path() . "\\app\\Services\\",
                'name' => "服务"
            ],
        ];

        // 模板文件路径
        $tmpPath = base_path() . "\\resources\\Template\\";
        // 组合命名空间和文件路径
        $middlePath =  $data['nameSpace'] . "\\" . $data['name'];

        // 返回结果
        $result = [Response::HTTP_OK, '批量代码生成成功！', []];

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
            // 获取模板文件内容
            $tmpCtrollerPath = $tmpPath . $value['file'];
            $tmpContent = file_get_contents($tmpCtrollerPath);

            // 替换文件内容
            $newContent = str_replace("{{nameSpace}}", $data['nameSpace'], $tmpContent);         # 替换命名空间
            $newContent = str_replace("{{Template}}", $data['name'], $newContent);               # 替换类名

            // model 需要特殊处理
            if ($value['type'] == "Model") {
                $newContent = str_replace("{{table}}", $data['table'], $newContent);             # 替换表名
                $newContent = str_replace("{{primaryKey}}", $data['primaryKey'], $newContent);   # 替换主键
                $newContent = str_replace("{{columns}}", $data['columns'], $newContent);         # 替换模型列数据
            }

            // 输出文件 
            if (($myFile = fopen($value['path'] . $middlePath . $value['file'], "w+")) === false) {
                $result[0] = Response::HTTP_INTERNAL_SERVER_ERROR;
                $result[1] = "创建文件失败，请检查权限！";
                break;
            }
            fwrite($myFile, $newContent);
            fclose($myFile);
        }

        // 异常返回终止继续执行
        if ($result[0] != 200) {
            return $this->failed($result[0], $result[1], $result[2]);
        }

        return $this->success($result[0], $result[1], $result[2]);
    }

    /**
     * 获取所有DB
     * @return ResultHelper
     */
    public function getDB()
    {
        try {
            $dbs = DB::select('SHOW DATABASES');
            $result = [];
            foreach ($dbs as $value) {
                // 过滤掉系统自带
                if (!in_array($value->Database, ['information_schema', 'default', 'mysql', 'performance_schema', 'sys'])) {
                    $result[] = ['database' => $value->Database];
                }
            }
            $result = $this->success(Response::HTTP_OK, '获取分页数据成功！', ['dbs' => $result]);
        } catch (\Exception $ex) {
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
        }
        return $result;
    }

    /**
     * 根据库名找到所有表
     * @param string $dbName
     * @return ResultHelper
     */
    public function getTables(string $dbName)
    {
        try {
            $query = "SELECT table_name FROM information_schema.tables WHERE TABLE_SCHEMA='$dbName'";
            $tables = DB::select($query);
            $result = [];
            foreach ($tables as $value) {
                $result[] = ['tableName' => $value->table_name];
            }
            $result = $this->success(Response::HTTP_OK, '获取分页数据成功！', ['tables' => $result]);
        } catch (\Exception $ex) {
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
        }
        return $result;
    }

    /**
     * 根据表名找到所有列
     * @param array $data[dbName,tableName]
     * @return ResultHelper
     */
    public function getColume(array $data)
    {
        $dbName = $data['dbName'];
        $tableName = $data['tableName'];
        try {
            $query = "SELECT COLUMN_NAME,COLUMN_COMMENT,DATA_TYPE,CHARACTER_MAXIMUM_LENGTH FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='$dbName' AND TABLE_NAME = '$tableName' ";
            $columes = DB::select($query);
            $result = [];
            foreach ($columes as $value) {
                $result[] = [
                    'columnComment' => $value->COLUMN_COMMENT,
                    'columnName' => $value->COLUMN_NAME,
                    'dataType' => $value->DATA_TYPE,
                    'dataTypeLong' => $value->CHARACTER_MAXIMUM_LENGTH,
                ];
            }
            $result = $this->success(Response::HTTP_OK, '获取分页数据成功！', ['columns' => $result]);
        } catch (\Exception $ex) {
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
        }
        return $result;
    }
}
