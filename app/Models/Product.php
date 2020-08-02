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
    protected $fillable = ['name', 'image', 'category', 'status', 'price', 'content'];
    public $timestamps = false;

    public static $status = [
        '0' => "ON",
        '1' => "OFF"
    ];

    public static function getIndex()
    {
        $data = self::get();
        return $data;
    }

    public static function createProduct($data)
    {
        $data = self::makeImage($data);
        $model = new Product();
        $model->fill($data);
        if ($model->save()) {
            return $model;
        }

        return false;
    }

    public static function makeImage($data) {
        $pathProduct = "C:/xampp7.2/htdocs/bloggg/public/img/product";
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
}
