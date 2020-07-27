<?php

namespace App\models\Chapter;

use App\Helpers\ApiHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Chapter extends Model
{
    protected $table = 'chapters';
    
    public function getChapter($param = array(), $page=false, $count = 10){
        $query = DB::table('chapters as c');

        if(!empty($param['id'])){
            $query->where('c.id', $param['id']);
        }
        if(!empty($param['genre'])){
            $query->where('c.genre', $param['genre']);
        }
        if(!empty($param['title'])){
            $query->where('c.title', $param['title']);
        }

        $query->leftJoin('novel as n', 'c.novel_id', '=', 'n.id');
        $query->select('c.*','n.title as novel');

        if($page){
            $result=$query->paginate($count);
        }else{
            $result = $query->get();
        }
        
        $msg = ApiHelpers::FLAG_RESULT($result);

        return array($result, $msg);
    }

    public function saveChapter($param = array(), $id=''){
        DB::enableQueryLog();
        $query = DB::table('chapters');
        if($id){
            $query->where('id', $id);
            $result = $query->update($param);
            $msg = ApiHelpers::FLAG_UPDATE($result);
        }else{
            $result = $query->insert($param);
            $id = DB::getPDO()->lastInsertId();
            $msg = ApiHelpers::FLAG_INSERT($result);
        }
        // die(var_dump(DB::getQueryLog()));
        return array($result, $id, $msg);
    }

    public function deleteChapter($id){
        $query = DB::table('chapters');
        $query->where('id', $id);
        $result = $query->delete();
        $msg = ApiHelpers::FLAG_DELETE($result);

        return array($result, $msg);
    }
}
