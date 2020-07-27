<?php

namespace App\models\TypeUser;

use App\Helpers\ApiHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TypeUser extends Model
{
    function getTypeUser($param = array())
    {
        $table = DB::table('type_users as tu');
        if (!empty($param['id'])) {
            $table->where('tu.id', $param['id']);
        }
        if(!empty($param['name'])){
            $table->where('tu.name', $param);
        }

        // $table->leftJoin('chaptes as c', 'r.chapter_id', '=', 'c.id');
        $table->select('tu.*');
        $result = $table->get();
        $msg = ApiHelpers::FLAG_RESULT($result);

        return array($result, $msg);
    }

    function saveTypeUser($param = array(), $id = '')
    {
        $table = DB::table('type_users');
        if ($id) {
            $table->where('id', $id);
            $result = $table->update($param);
            $msg = ApiHelpers::FLAG_UPDATE($result);
        } else {
            $result = $table->insert($param);
            $id = DB::getPDO()->lastInsertId();
            $msg = ApiHelpers::FLAG_INSERT($result);
        }

        return array($result, $id, $msg);
    }

    function deleteTypeUser($id)
    {
        $table = DB::table('type_users');
        $result = $table->where('id', $id)->delete();
        $msg = ApiHelpers::FLAG_DELETE($result);

        return array($result, $msg);
    }
}
