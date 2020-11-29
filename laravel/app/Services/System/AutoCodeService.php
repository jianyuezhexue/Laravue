<?php

namespace App\Services\System;

use App\Services\Service;
use App\Utils\ResultHelper;
use App\Utils\ZipFile;
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
                'path' => base_path() . "/app/Http/Controllers/",
                'name' => "控制器"
            ],
            [
                'type' => "Model",
                'file' => "Model.php",
                'path' => base_path() . "/app/Models/",
                'name' => "模型"
            ],
            [
                'type' => "Service",
                'file' => "Service.php",
                'path' => base_path() . "/app/Services/",
                'name' => "服务"
            ],
        ];

        // 模板文件路径
        $tmpPath = base_path() . "/resources/Template/";
        // 命名空间路径
        $nameSpacePath =  $data['nameSpace'] . "/";
        // 组合命名空间和文件路径
        $middlePath =  $data['nameSpace'] . "/" . $data['className'];

        // 返回结果
        $result = [Response::HTTP_OK, '批量代码生成成功！', []];

        // 1.检查文件是否存在
        foreach ($autoCodeConfig as $value) {
            if (file_exists($value['path'] . $middlePath . $value['file'])) {
                $result[0] = Response::HTTP_INTERNAL_SERVER_ERROR;
                $result[1] = "{$data['nameSpace']}/{$data['className']}{$value['file']}文件已经存在，请检查!";
                break;
            }
        }

        // 异常返回终止继续执行
        if ($result[0] != 200) {
            return $this->failed($result[0], $result[1], $result[2]);
        }

        // 2.文件生成处理
        foreach ($autoCodeConfig as $value) {
            // 获取模板文件内容
            $tmpCtrollerPath = $this->tmpPath . $value['file'];
            $tmpContent = file_get_contents($tmpCtrollerPath);

            // 替换文件内容
            $newContent = str_replace("{{nameSpace}}", $data['nameSpace'], $tmpContent);         # 替换命名空间
            $newContent = str_replace("{{Template}}", $data['className'], $newContent);          # 替换类名

            // model 需要特殊处理
            if ($value['type'] == "Model") {
                $newContent = str_replace("{{table}}", $data['tableName'], $newContent);          # 替换表名
                $newContent = str_replace("{{primaryKey}}", $data['primaryKey'], $newContent);    # 替换主键
                $newContent = str_replace("{{columns}}", $data['columns'], $newContent);          # 替换模型列数据
            }

            // 检测命名空间文件夹｜存在｜创建
            if (!is_dir($value['path'] . $nameSpacePath)) {
                mkdir($value['path'] . $nameSpacePath);
            }

            // 输出本地文件 
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

        // 3.如果需要建立数据库

        return $this->success($result[0], $result[1], $result[2]);
    }

    /**
     * 自动创建所有文件
     * @param array $data [autoCode: 0->只下载代码，不生成本地代码 / 1-> 下载代码的同时并生成本地代码]
     * @return ResultHelper
     */
    public function autoCodeNew(array $data)
    {
        /** 配置文件 */
        // 文件配置数组
        $autoCodeConfig = [
            [
                'type' => "Controller",
                'file' => "Controller.php",
                'path' => base_path() . "/app/Http/Controllers/",
                'name' => "控制器"
            ],
            [
                'type' => "Model",
                'file' => "Model.php",
                'path' => base_path() . "/app/Models/",
                'name' => "模型"
            ],
            [
                'type' => "Service",
                'file' => "Service.php",
                'path' => base_path() . "/app/Services/",
                'name' => "服务"
            ],
            [
                'type' => "Route",
                'file' => "Route.php",
                'path' => base_path() . "/routes/",
                'name' => "路由"
            ],
            [
                'type' => "Api",
                'file' => ".js",
                'path' => base_path() . "/routes/", // TODO:更换到前台地址
                'name' => "前端API接口"
            ],
            [
                'type' => "index",
                'file' => ".vue",
                'path' => base_path() . "/routes/", // TODO:更换到前台地址
                'name' => "前端API接口"
            ],
        ];

        // 模板文件路径
        $tmpPath = base_path() . "/resources/Template/";
        // 生成的预下载文件夹路径
        $preTmpPath = base_path() . "/resources/autoCode/tmp/";
        // 生成下载zip文件路径
        $zipPath = base_path() . "/resources/autoCode/";
        // 命名空间路径（拼接用）
        $nameSpacePath =  $data['nameSpace'] . "/";
        // 组合命名空间和文件路径（拼接用）
        $middlePath =  $data['nameSpace'] . "/" . $data['className'];
        // 初始化压缩文件封装类
        $zipFile = new ZipFile();
        // 返回结果
        $result = [Response::HTTP_OK, '批量代码生成成功！', []];

        /** 前置校验 */
        // 1.检查文件是否存在
        foreach ($autoCodeConfig as $value) {
            if (file_exists($value['path'] . $middlePath . $value['file'])) {
                $result[0] = Response::HTTP_INTERNAL_SERVER_ERROR;
                $result[1] = "{$data['nameSpace']}/{$data['className']}{$value['file']}文件已经存在，请检查!";
                break;
            }
        }
        if ($result[0] != 200) { // 循环中的异常判断
            return $this->failed($result[0], $result[1], $result[2]);
        }

        // 2.重置预下载目录|清空并新建tmp文件夹
        if (!is_dir($zipPath)) { // 考虑刚拉代码没有此文件夹的情况
            mkdir($zipPath);
        }
        $zipFile->deldir($zipPath);
        mkdir($preTmpPath);

        /** 业务代码 */
        // 3.文件生成处理
        foreach ($autoCodeConfig as $value) {
            // 获取模板文件内容
            $tmpCtrollerPath = $tmpPath . $value['type'] . ".tpl";
            $tmpContent = file_get_contents($tmpCtrollerPath);

            // 替换文件内容
            $newContent = str_replace("{{nameSpace}}", $data['nameSpace'], $tmpContent);         # 替换命名空间
            $newContent = str_replace("{{Template}}", $data['className'], $newContent);          # 替换类名

            // model 需要特殊处理
            if ($value['type'] == "Model") {
                $newContent = str_replace("{{table}}", $data['tableName'], $newContent);         # 替换表名
                $newContent = str_replace("{{primaryKey}}", $data['primaryKey'], $newContent);   # 替换主键
                $newContent = str_replace("{{columns}}", $data['columns'], $newContent);         # 替换模型列数据
            }

            // Route 和 Api 需要特殊处理
            if ($value['type'] == "Api" || $value['type'] == "Route") {
                $newContent = str_replace("{{apiName}}", $data['apiName'], $newContent);         # 替换路由小写
            }

            // VUE文件特殊处理
            if ($value['type'] == "index") {
                $newContent = $this->indexVueContent($newContent, $data['fields'], $data);       # vue文件内容处理
            }

            // 检测命名空间文件夹｜不存在则创建
            if (!is_dir($value['path'] . $nameSpacePath)) {
                mkdir($value['path'] . $nameSpacePath);
            }

            // autoCode文件 
            if ($data['autoCode'] == 1 && in_array($value['type'], ['Controller', 'Model', 'Service', 'Route'])) { // TODO:后面追加前端的
                if (($myFile = fopen($value['path'] . $middlePath . $value['file'], "w+")) === false) {
                    $result[0] = Response::HTTP_INTERNAL_SERVER_ERROR;
                    $result[1] = "autoCode创建文件失败，请检查权限！";
                    break;
                }
                fwrite($myFile, $newContent);
                fclose($myFile);
            }

            // 生成预下载文件
            $tmpClassName = $value['type'] === 'Api' ? $data['apiName'] : $data['className'];
            if ($value['type'] === 'Api') {
                $tmpClassName = $data['apiName'];     # API文件（小驼峰）
            } else if ($value['type'] === 'index') {
                $tmpClassName = 'index';              # index.vue
            } else {
                $tmpClassName = $data['className'];   # 后台文件
            }
            if (($myFile = fopen($zipPath . 'tmp/' . $tmpClassName . $value['file'], "w+")) === false) {
                $result[0] = Response::HTTP_INTERNAL_SERVER_ERROR;
                $result[1] = "预下载创建文件失败，请检查权限！";
                break;
            }
            fwrite($myFile, $newContent);
            fclose($myFile);
        }
        if ($result[0] != 200) { // 异常处理
            return $this->failed($result[0], $result[1], $result[2]);
        }

        // 4.生成压缩包文件
        $filename = $zipFile->addFileToZip($preTmpPath, $zipPath . "tmp.zip");
        if ($filename['code'] !== 200) {
            return $this->failed($filename['code'], $filename['msg']);
        }

        // 5.创建数据库表

        // 6.输出二进制流文件(BLOB)
        $this->blobData($filename['data']);
    }

    /**
     * VUE文件内容循环处理
     * @param string $newContent
     * @param array $fileds
     * @param array $data
     * @return string $newContent
     */
    private function indexVueContent(string $newContent, array $fileds, array $data)
    {
        /** 1.替换搜索表单 */
        $searchTmp = "<el-form-item><el-input v-model=\"searchInfo.{{fieldName}}\" placeholder=\"{{fieldDesc}}\" clearable :style=\"{ width: '100%' }\" ></el-input></el-form-item>" . PHP_EOL;
        $searchRepalce = "";

        /** 2.替换表单字段 */
        $tableTmp = "<el-table-column label=\"{{fieldDesc}}\" prop=\"{{fieldName}}\" width=\"180\"></el-table-column>" . PHP_EOL;
        $tableRepalce = "";

        /** 3.替换弹窗表单 */
        $formTmp = "<el-form-item label=\"{{fieldDesc}}\" prop=\"title\"><el-input v-model=\"formData.{{fieldName}}\" placeholder=\"请输入{{fieldDesc}}\" clearable :style=\"{ width: '100%' }\" ></el-input></el-form-item>" . PHP_EOL;
        $formRepalce = "";

        /** 4.替换formData*/
        $formData = "";

        /** 5.替换校验规则(必填)*/
        $ruleTmp = "{{fieldName}}: [{ required: true, message: \"请输入{{fieldDesc}}\", trigger: \"blur\",}]," . PHP_EOL;
        $ruleRepalce = "";

        foreach ($fileds as $filed) {
            // 搜索表单生成
            if ($filed['fieldSearchType']) {
                $searchOne = str_replace("{{fieldName}}", $filed['columnName'], $searchTmp);
                $searchOne = str_replace("{{fieldDesc}}", $filed['fieldDesc'], $searchOne);
            } else {
                $searchOne = "";
            }
            $searchRepalce .= $searchOne;

            // 数据表格生成
            $tableOne = str_replace("{{fieldName}}", $filed['columnName'], $tableTmp);
            $tableOne = str_replace("{{fieldDesc}}", $filed['fieldDesc'], $tableOne);
            $tableRepalce .= $tableOne;

            // 弹窗表单生成
            $formOne = str_replace("{{fieldName}}", $filed['columnName'], $formTmp);
            $formOne = str_replace("{{fieldDesc}}", $filed['fieldDesc'], $formOne);
            $formRepalce .= $formOne;

            // 生成formData
            $formData .= $filed['fieldName'] . ":null,";

            // 生成表单验证规则
            $ruleOne = str_replace("{{fieldName}}", $filed['columnName'], $ruleTmp);
            $ruleOne = str_replace("{{fieldDesc}}", $filed['fieldDesc'], $ruleOne);
            $ruleRepalce .= $ruleOne;
        }

        // 集中替换
        $newContent = str_replace("{{search}}", $searchRepalce, $newContent);
        $newContent = str_replace("{{table}}", $tableRepalce, $newContent);
        $newContent = str_replace("{{form}}", $formRepalce, $newContent);
        $newContent = str_replace("{{formData}}", "{" . $formData . "}", $newContent);
        $newContent = str_replace("{{rules}}", "{" . $ruleRepalce . "}", $newContent);

        /** 6.替换API请求引入 */
        $newContent = str_replace("{{apiName}}", $data['apiName'], $newContent);
        /** 7.替换类名 */
        $newContent = str_replace("{{className}}", $data['className'], $newContent);

        return $newContent;
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
            $result = $this->success(Response::HTTP_OK, '获取所有DB成功！', ['dbs' => $result]);
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
            $result = $this->success(Response::HTTP_OK, '获取所有表成功！', ['tables' => $result]);
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
                    'columeComment' => $value->COLUMN_COMMENT,
                    'columeName' => $value->COLUMN_NAME,
                    'dataType' => $value->DATA_TYPE,
                    'dataTypeLong' => $value->CHARACTER_MAXIMUM_LENGTH,
                ];
            }
            $result = $this->success(Response::HTTP_OK, '获取所有列数据成功！', ['columes' => $result]);
        } catch (\Exception $ex) {
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
        }
        return $result;
    }
}
