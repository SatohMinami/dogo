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
        $categories = $this->category->getDataMain();
        $data = $this->product->getProduct($categories);

        return view('frontend.home')->with('data', $data);
    }
}
