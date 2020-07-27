<?php

namespace App\models\Menu;

use App\Helpers\ApiHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    protected $table = 'menu';

    function getMenu($param = array()){
        $table = DB::table('menu as mn');
        if(!empty($param['id'])){
            $table->where('mn.id', $param['id']);
        }
        if(!empty($param['menu'])){
            $table->where('mn.menu', $param['menu']);
        }

        $table->orderBy('id', 'DESC');
        $table->select('mn.*');

        $result = $table->get();
        $msg = ApiHelpers::FLAG_RESULT($result);

        return array($result, $msg);
    }

    function saveMenu($param = array(), $id = ''){
        $table = DB::table('menu');
        if($id){
            $table->where('id', $id);
            $result = $table->update($param);
            $msg = ApiHelpers::FLAG_UPDATE($result);
        }else{
            $result = $table->insert($param);
            $id = DB::getPDO()->lastInsertId();
            $msg = ApiHelpers::FLAG_INSERT($result);
        }

        return array($result, $id, $msg);
    }

    function deleteMenu($id){
        $table = DB::table('menu');
        $result = $table->where('id', $id)->delete();
        $msg = ApiHelpers::FLAG_DELETE($result);

        return array($result, $msg);
    }
}
