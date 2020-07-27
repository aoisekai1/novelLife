<?php

namespace App\models\Members;

use App\Helpers\ApiHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Members extends Model
{
    public function getMembers($param = array(), $page = false){
        DB::enableQueryLog();
        $pageNumber = 10;
        $query = DB::table('members as m');

        if(!empty($param['id'])){
            $query->where('m.id', $param['id']);
        }
        if(!empty($param['name'])){
            $query->where('m.name', $param['name']);
        }
        if(!empty($param['email'])){
            $query->where('m.email', $param['email']);
        }

        $query->join('type_users as tu', 'm.type_user', '=', 'tu.id');
        $query->select('m.*', 'tu.name as role');
        
        if($page){
            $query =  $query->paginate($pageNumber);
        }else{
            $query = $query->get();
        }
        $msg = ApiHelpers::FLAG_RESULT($query);
        // die(var_dump(DB::getQueryLog()));
        return array($query, $msg);
    }

    public function saveMember($param = array(), $id = null){
        $table = DB::table('members');
        
        if($id){
            $result = $table->where('id', $id)->update($param);
            $msg = ApiHelpers::FLAG_INSERT($result);
        }else{
            $result = $table->insert($param);
            $id = DB::getPDO()->lastInsertId();
            $msg = ApiHelpers::FLAG_INSERT($result); 
        }

        return array($result, $id, $msg);
    }

    public  function deleteMember($id){
        $result = DB::table('members')->where('id', $id)->delete();
        $msg = ApiHelpers::FLAG_DELETE($result);
        
        return array($result, $msg);
    }
}
