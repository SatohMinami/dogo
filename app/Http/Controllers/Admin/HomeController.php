<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
//    public $languages;
//
//    public function __construct()
//    {
//        $this->languages = ShopLanguage::getList();
//
//    }

    public function index()
    {
        return view('admin.home');
    }
}
