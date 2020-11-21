<?php

namespace App\Services\System;

use App\Services\Service;
use App\Utils\ResultHelper;
use Illuminate\Support\Facades\DB;
use App\Models\System\DictionaryModel;
use App\Models\System\DictionaryDetailModel;
use Symfony\Component\HttpFoundation\Response;

class DictionaryService extends Service
{
    use ResultHelper;
    protected $model;
    protected $dictionaryDetailModel;

    // 模糊查询
    protected $likeSearch = "desc";

    public function __construct(DictionaryModel $model, DictionaryDetailModel $dictionaryDetailModel)
    {
        $this->model = $model;
        $this->dictionaryDetailModel = $dictionaryDetailModel;
    }

    /**
     * 根据父级ID或者Type获取子集所有数据
     * @param string $type
     */
    public function find($type)
    {
        try {
            if (is_numeric($type)) {
                $result = $this->model->where('id', $type)->first();
            } else {
                $result = $this->model->where('type', $type)->with('sysDictionaryDetails')->first();
            }
            $result = $this->success(Response::HTTP_OK, '获取全部数据成功！', ["resysDictionary" => $result]);
        } catch (\Exception $ex) {
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
        }
        return $result;
    }

    /**
     * 指定ID删除数据连带子集中的数据
     * @param string $id
     * @return ResultHelper
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            // 删除父级数据
            $result = $this->model->destroy($id);
            // 删除子集中的数据
            $result = $this->dictionaryDetailModel->where('sys_dictionary_id', $id)->delete();
            $result = $this->success(Response::HTTP_OK, '删除数据成功', $result);
            DB::commit();
        } catch (\Exception $ex) {
            $result = $this->failed(Response::HTTP_INTERNAL_SERVER_ERROR, $ex->getMessage());
            DB::rollBack();
        }
        return $result;
    }
}
