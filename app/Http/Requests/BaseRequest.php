<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class BaseRequest extends FormRequest
{

    protected $routeName;
    protected $auth;

    public function __construct(Request $request)
    {
        $this->routeName = $request->route()->getName() ? $request->route()->getName() : null;
        $this->auth = auth('web')->user();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function response(array $errors)
    {
        return ApiResult(422, 'INVALID PARAMETER', null, $errors, 'VALIDATE');
    }

}
