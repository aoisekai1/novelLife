<?php

namespace App\models\SocialMedia;

use App\Helpers\ApiHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SocialMedia extends Model
{
    function getSocialMedia($param = array(), $page=false, $perPage=15){
        $table = DB::table('social_media as sm');
        if(!empty($param['id'])){
            $table->where('sm.id', $param['id']);
        }
        if(!empty($param['social_media'])){
            $table->where('sm.social_media', $param['social_media']);
        }

        $table->leftJoin('members as m','sm.member_id','=','m.id');
        $table->orderBy('sm.id','DESC');
        $table->select('sm.*', 'm.name');

        if($page){
            $result = $table->paginate($perPage);
        }else{
            $result = $table->get();
        }
        $msg = ApiHelpers::FLAG_RESULT($result);

        return array($result, $msg);
    }

    function saveSocialMedia($param = array(), $id = ''){
        $table = DB::table('social_media');
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

    function deleteSocialMedia($id){
        $table = DB::table('social_media');
        $result = $table->where('id', $id)->delete();
        $msg = ApiHelpers::FLAG_DELETE($result);

        return array($result, $msg);
    }
}
