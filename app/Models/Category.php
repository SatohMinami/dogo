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
    protected $fillable = ['id', 'alias', 'status', 'parent'];

    public static function getData() {
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


    public static function getDataMain() {
        $data['parent'] = Category::select('id', 'alias', 'parent')
            ->where('parent', '=',0)
            ->get()
            ->toArray();
        $data['child'] =  Category::select('id', 'alias', 'parent')
            ->where('parent', '!=',0)
            ->get()
            ->toArray();

        $datas = [];
        foreach ($data['parent'] as $v) {
            foreach ($data['child'] as $val) {
                if($val['parent'] ==  $v['id']) {
                    $datas[$v['alias']]['name'] =  $v['alias'];
                    $datas[$v['alias']]['id'] =  $v['id'];
                    $datas[$v['alias']]['array'][] = $val['id'];
                }
            }
        }

        return $datas;
    }


}
