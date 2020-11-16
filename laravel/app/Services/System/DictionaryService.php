<?php

namespace App\Services\System;

use App\Services\Service;
use App\Utils\ResultHelper;
use App\Models\System\DictionaryModel;
use Symfony\Component\HttpFoundation\Response;

class DictionaryService extends Service
{
    use ResultHelper;
    protected $model;

    // 模糊查询
    protected $likeSearch = "desc";

    public function __construct(DictionaryModel $model)
    {
        $this->model = $model;
    }

    /**
     * 根据父级Type获取子集所有数据
     * @param string $type
     */
    public function find($type)
    {
        try {
            // 先根据type找到父级id
            $result = $this->model->where('type', $type)->with('sysDictionaryDetails')->first();
            $result = $this->success(Response::HTTP_OK, '获取全部数据成功！', ["resysDictionary" => $result]);
        } catch (\Exception $ex) {
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
        }
        return $result;
    }
}
