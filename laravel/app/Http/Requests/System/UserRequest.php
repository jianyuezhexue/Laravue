<?php

namespace App\Http\Requests\System;

use App\Http\Requests\BaseRequest;

class UserRequest extends BaseRequest
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
                        'username' => 'required',
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
            'username.required' => '用户名必填！',
        ];
    }
}
