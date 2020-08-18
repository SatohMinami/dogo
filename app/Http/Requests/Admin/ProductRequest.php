<?php

namespace App\Http\Requests\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\BaseRequest;

class ProductRequest extends BaseRequest
{
    protected $action;
    const PRODUCT_CREATE = 'admin.product.create';
    const PRODUCT_UPDATE = 'admin.product.update';
    const PRODUCT_DELETE = 'admin.product.delete';

    public function __construct(Request $request)
    {
        $this->action = $request->route()->getName();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        switch ($this->action) {
            case self::PRODUCT_CREATE :
                $rules['name']           = ['required'];
                $rules['image']          = ['required', 'mimes:jpg,jpeg,png'];
                $rules['category']       = ['required', 'numeric'];
                $rules['price']          = ['required', 'numeric'];
                $rules['status']         = ['required', 'numeric'];
                $rules['content']        = ['required'];
                break;
            case self::PRODUCT_UPDATE :
                $rules['name']           = ['required'];
                if ($this->has("image")) {
                    $rules['image']          = ['required', 'mimes:jpg,jpeg,png'];
                }
                $rules['category']       = ['required', 'numeric'];
                $rules['price']          = ['required', 'numeric'];
                $rules['status']         = ['required', 'numeric'];
                $rules['content']        = ['required'];
                break;
//            case self::PRODUCT_DELETE:
//                $rules['id']             = ['required', 'numeric'];
//                break;
            default :
                break;
        }

        return $rules;

//        return [
//            'name' => 'required|unique:sc_shop_product',
//            'image' => 'required|mimes:jpg,jpeg,png',
//            'category' => 'required|numeric',
//            'price' => 'required|numeric',
//            'status' => 'required|numeric',
//            'content' => 'required'
//        ];
    }

    public function messages()
    {
        $messages = parent::messages();
        return $messages;
    }

    public function attributes()
    {
        $attributes = [
            'alias'         => 'alias',
            'image'         => 'image',
            'category'      => 'category',
            'status'        => 'status',
            'content'       => 'content',
        ];
        return $attributes;
    }

}
