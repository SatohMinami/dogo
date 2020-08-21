<?php
namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public $category;
    public $product;

    public function __construct(Category $category, Product $product)
    {
        $this->product  = $product;
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->getCategories();
        $data = $this->product->getProduct($categories);

        return view('frontend.home')->with('data', $data);
    }

    public function getCategory($id) {
        $childCategory = $this->category->getChildByParentCategory($id);
        $data = $this->product->getProductByCategory($childCategory);

        return view('frontend.category')->with('data', $data);
    }
}
