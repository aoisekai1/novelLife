<?php

namespace App\models\Rate;

use App\Helpers\ApiHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rate extends Model
{
    function getRate($param = array()){
        $table = DB::table('rate as r');
        if(!empty($param['id'])){
            $table->where('r.id', $param['id']);
        }

        // $table->leftJoin('chaptes as c', 'r.chapter_id', '=', 'c.id');
        $table->select('r.*');
        $result = $table->get();
        $msg = ApiHelpers::FLAG_RESULT($result);

        return array($result, $msg);
    }

    function saveRate($param = array(), $id = ''){
        $table = DB::table('rate');
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

    function deleteRate($id){
        $table = DB::table('rate');
        $result = $table->where('id', $id)->delete();
        $msg = ApiHelpers::FLAG_DELETE($result);

        return array($result, $msg);
    }
}
