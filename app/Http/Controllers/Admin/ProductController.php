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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->product->getIndex();
        return view('admin.product.index')->with('datas', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->category->getData();
        return view('admin.product.create')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $param = $request->only('name', 'image', 'category', 'price', 'gender', 'presence', 'status', 'content');
        $param['category'] = (int) $param['category'];
        $data = Product::createProduct($param);
        if (!$data) {

        }

        return redirect()->route('admin.product.index');;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->product->getDetail($id);
        $catetory = $this->category->getData();

        return view('admin.product.edit')->with(['data' => $data, 'category' => $catetory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request)
    {
        $param = $request->only('id', 'name', 'image', 'category', 'price', 'gender', 'presence', 'status', 'content');
        $param['category'] = (int) $param['category'];
        $data = Product::UpdateProduct($param);
        if (!$data) {

        }

        return redirect()->route('admin.product.index');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::destroy($id);
        if ($data) {

        }

        return redirect()->route('admin.product.index');
    }
}
