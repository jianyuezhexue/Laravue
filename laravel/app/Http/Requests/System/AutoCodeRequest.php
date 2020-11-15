<?php

namespace App\Http\Requests\System;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\BaseRequest;

class AutoCodeRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        switch ($this->method()) {
            case 'GET': {
                    return [];
                }
            case 'POST': {
                    return [
                        'nameSpace' => 'required',
                        'name' => 'required',
                        'table' => 'required',
                        'primaryKey' => 'required',
                        'columns' => 'required',
                        'autoCode' => 'required',
                    ];
                }
            case 'PUT': {
                    return [];
                }
            case 'PATCH': {
                    return [];
                }
            case 'DELETE': {
                    return [];
                }
            default: {
                    return [];
                }
        }
    }

    public function messages()
    {
        return [
            'nameSpace.required'  => '模块为必填！',
            'name.required'       => '类名为必填！',
            'table.required'      => '表名为必填！',
            'primaryKey.required' => '主键为必填！',
            'columns.required'    => '表列为必填！',
            'autoCode.required'    => '是否生成本地代码为必填！',
        ];
    }
}
