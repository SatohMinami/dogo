<?php

namespace App\Http\Requests\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\BaseRequest;

class ProductRequest extends BaseRequest
{

    const PRODUCT_CREATE = 'admin.product.create';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
//        $rules = [];
//        switch ($this->routeName) {
//            case self::PRODUCT_CREATE :
//                $rules['alias']          = ['required', 'numeric'];
//                $rules['image']          = ['required'];
//                $rules['category']       = ['required'];
//                $rules['status']         = ['required'];
//                $rules['content']        = ['required'];
//                break;
//            default :
//                break;
//        }
//
//        return $rules;

        return [
            'name' => 'required|unique:sc_shop_product',
            'image' => 'required|mimes:jpg,jpeg,png',
            'category' => 'required|numeric',
            'price' => 'required|numeric',
            'status' => 'required|numeric',
            'content' => 'required'
        ];
    }

//    public function messages()
//    {
//        $messages = parent::messages();
//        return $messages;
//    }
//
//    public function attributes()
//    {
//        $attributes = [
//            'alias'         => 'alias',
//            'image'         => 'image',
//            'category'      => 'category',
//            'status'        => 'status',
//            'content'       => 'content',
//        ];
//        return $attributes;
//    }

}
