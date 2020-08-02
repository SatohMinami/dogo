<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
//use App\Models\ShopCategoryDescription;
//use App\Models\ShopLanguage;
//use App\Models\ShopCategoryDescription;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
    public $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getIndex()
    {
        return view('admin.category.index');
    }

    public function getCreate()
    {
//        $data = $this->category->getData();
//        return view('admin.category.create')->with($data);
        return view('admin.category.create');
    }

    public function postCreate()
    {
        $data = request()->all();

        $validator = Validator::make($data, [
            'image' => 'required',
            'parent' => 'required',
            'sort' => 'numeric|min:0'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($data);
        }

        $dataInsert = [
            'image' => $data['image'],
            'alias' => $data['alias'],
            'parent' => (int) $data['parent'],
            'top' => !empty($data['top']) ? 1 : 0,
            'status' => !empty($data['status']) ? 1 : 0,
            'sort' => (int) $data['sort'],
        ];
        $id = ShopCategory::insertGetId($dataInsert);
        $dataDes = [];
        $languages = $this->languages;
        foreach ($languages as $code => $value) {
            $dataDes[] = [
                'category_id' => $id,
                'lang' => $code,
                'title' => $data['descriptions'][$code]['title'],
                'keyword' => $data['descriptions'][$code]['keyword'],
                'description' => $data['descriptions'][$code]['description'],
            ];
        }
        ShopCategoryDescription::insert($dataDes);

        return redirect()->route('admin_category.index')->with('success', trans('category.admin.create_success'));

    }

    public function getEdit()
    {
        return view('admin.category.edit');
    }

}
