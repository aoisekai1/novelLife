<?php

namespace App\models\Novels;

use App\Helpers\ApiHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Novels extends Model
{
    //
    function getNovels($param = array(), $page=false, $perPage=15){
        $table = DB::table('novel as n');
        if(!empty($param['id'])){
            $table->where('n.id', $param['id']);
        }
        if(!empty($param['title'])){
            $table->where('n.title', $param['title']);
        }
        if(!empty($param['genre'])){
            $table->where('n.genre', $param['genre']);
        }

        $table->orderBy('n.id','DESC');
        $table->select('n.*');

        if($page){
            $result = $table->paginate($perPage);
        } else {
            $result = $table->get();
        }
        $msg = ApiHelpers::FLAG_RESULT($result);
        return array($result, $msg);
    }

    function saveNovel($param = array(), $id = ''){
        $table = DB::table('novel');
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

    function deleteNovel($id){
        $table = DB::table('novel');
        $result = $table->where('id', $id)->delete();
        $msg = ApiHelpers::FLAG_DELETE($result);

        return array($result, $msg);
    }
}
