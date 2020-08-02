<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
//use App\Models\ShopCategory;
//use App\Models\ShopCategoryDescription;
//use App\Models\ShopLanguage;
use Illuminate\Http\Request;
use Validator;

class BrandController extends Controller
{
//    public $languages;
//
//    public function __construct()
//    {
//        $this->languages = ShopLanguage::getList();
//
//    }

    public function getIndex()
    {
        return view('admin.brand.index');
    }

    public function getCreate()
    {

        return view('admin.brand.create');
    }

    public function getEdit()
    {
        return view('admin.brand.edit');
    }

}
