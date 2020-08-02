<?php
namespace App\Models;

use Cache;
use Illuminate\Database\Eloquent\Model;
use App\Models\ModelTrait;

class Category extends Model
{
    use ModelTrait;

    public $timestamps = false;
    public $table = 'sc_shop_category';
    protected $fillable = ['id', 'image', 'alias', 'status'];

    public function getData() {
       $data = Category::select('id', 'alias', 'parent')
                ->get()
                ->toArray();
       $data = Category::buildTree($data, 0);

       return $data;
    }

    static function buildTree($data, $parentId = 0) {
        $childs = array();
        foreach ($data as $value) {
            if ($value['parent'] == $parentId) {
                $children = Category::buildTree($data, $value['id']);
                if ($children) {
                    $value['children'] = $children;
                }
                $childs[$value['id']] = $value;
            }
        }

        return $childs;
    }

    public static function getNameCategory() {
        $data = Category::select('id', 'alias')->get()->toArray();

        return $data;
    }
}
