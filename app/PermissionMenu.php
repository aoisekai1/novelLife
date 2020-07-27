<?php

namespace App\models\PermissionMenu;

use App\Helpers\ApiHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PermissionMenu extends Model
{
    function getPermission($param = array())
    {
        $table = DB::table('permission_menu as pm');
        if (!empty($param['id'])) {
            $table->where('pm.id', $param['id']);
        }

        // $table->leftJoin('chaptes as c', 'r.chapter_id', '=', 'c.id');
        $table->select('pm.*');
        $result = $table->get();
        $msg = ApiHelpers::FLAG_RESULT($result);

        return array($result, $msg);
    }

    function savePermission($param = array(), $id = '')
    {
        $table = DB::table('permission_menu');
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

    function deletePermission($id)
    {
        $table = DB::table('permission_menu');
        $result = $table->where('id', $id)->delete();
        $msg = ApiHelpers::FLAG_DELETE($result);

        return array($result, $msg);
    }
}
