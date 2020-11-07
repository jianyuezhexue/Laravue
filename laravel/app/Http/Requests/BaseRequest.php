<?php

namespace App\Http\Requests;

use App\Utils\ResultHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class BaseRequest extends FormRequest
{
    use ResultHelper;
    public $error = null;

    protected function failedValidation(Validator $validator)
    {
        $error = $validator->errors()->all();
        throw new HttpResponseException($this->fail($error));
    }

    protected function fail(array $errors): JsonResponse
    {
        return response()->json($this->failed(Response::HTTP_FORBIDDEN, $errors[0]));
    }

    protected function failedAuthorization()
    {
        throw new HttpResponseException(response()->json(
            $this->failed(Response::HTTP_FORBIDDEN, $this->error ? $this->error : '没有权限操作', '没有权限操作')
        ));
    }

    protected function getRequiredWithoutAllRules(array $data)
    {
        $rules = [];
        $required = 'required_without_all:';
        $oldData = $data;
        foreach ($data as $key => $value) {
            array_splice($oldData, $key, 1);
            $rules[$value] = $required . implode(",", $oldData);
            $oldData = $data;
        }
        return $rules;
    }
}
