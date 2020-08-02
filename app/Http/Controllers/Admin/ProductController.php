<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ProductRequest;
use Validator;

class ProductController extends Controller
{
    public $category;
    public $product;

    public function __construct(Category $category, Product $product)
    {
        $this->product  = $product;
        $this->category = $category;
    }

    public function getIndex()
    {
        $data = $this->product->getIndex();
        return view('admin.product.index')->with('datas', $data);
    }

    public function getCreate()
    {
       $data = $this->category->getData();
       return view('admin.product.create')->with('data', $data);
    }

    public function postCreate(ProductRequest $request)
    {
        $param = $request->only('name', 'image', 'category', 'price', 'status', 'content');
        $param['category'] = (int) $param['category'];
        $data = Product::createProduct($param);

        return redirect()->route('admin.product.index');;
    }

    public function getEdit()
    {
        return view('admin.product.edit');
    }

}
