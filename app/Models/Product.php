<?php
namespace App\Models;

use App\Models\ShopCategory;
use DB;
use Illuminate\Database\Eloquent\Model;
use Cache;
use App\Models\ModelTrait;
use Image;

class Product extends Model
{
    use ModelTrait;
    public $table = 'sc_shop_product';
    protected $fillable = ['id', 'name', 'image', 'category', 'status', 'price', 'content'];
    public $timestamps = false;

    public static $status = [
        '0' => "ON",
        '1' => "OFF"
    ];

    public static function getIndex()
    {
        $data = self::where('status', true)->get();
        return $data;
    }

    public static function createProduct($data)
    {
        $data = self::makeImage($data);
        $model = new Product();
        $model->fill($data);
        if ($model->save()) {
            return true;
        }

        return false;
    }

    public static function makeImage($data) {
        $pathProduct = "C:/xampp/htdocs/dogo/public/img/product";
        if(!is_dir($pathProduct)) {
            mkdir($pathProduct);
        }

        $imgFileName = $data['image']->getClientOriginalName();
        $fileImg = $pathProduct . DIRECTORY_SEPARATOR . $imgFileName;

        $img = Image::make($data['image'])->resize(300, 200);
        $img->save($fileImg);
        $data['image'] ="../img/product" . DIRECTORY_SEPARATOR . $imgFileName;

        return $data;
    }

    public static function getDetail($id) {
        $data = Product::find($id);
        return $data;
    }

    public static function UpdateProduct($data)
    {
        if(!empty($data['image'])) {
            $data = self::makeImage($data);
        }
        $model = new Product();
        $model = $model->find($data['id']);
        $model->fill($data);
        if ($model->save()) {
            return true;
        }

        return false;
    }

    public function getProduct($categories)
    {
        $products = Product::join('sc_shop_category', 'sc_shop_category.id', '=', 'sc_shop_product.category')
            ->select('sc_shop_product.id', 'sc_shop_product.image', 'sc_shop_product.name', 'sc_shop_product.price', 'sc_shop_product.category',
                'sc_shop_product.content', 'sc_shop_category.id', 'sc_shop_category.alias')
            ->where('sc_shop_product.status', true)
            ->get()
            ->toArray();

        $data = [];
        foreach ($categories as $category) {
            foreach ($products as $product) {
                if (in_array($product['category'], $category['array'])) {
                    $data[$category['id']]['name'] = $category['name'];
                    $data[$category['id']]['array'][] = $product;
                }
            }
        }

        return $data;
    }
}
