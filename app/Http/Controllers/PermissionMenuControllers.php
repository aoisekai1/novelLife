<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelpers;
use App\models\PermissionMenu\PermissionMenu;
use Illuminate\Http\Request;

class PermissionMenuControllers extends Controller
{
    
    function __construct(Request $request, PermissionMenu $permission)
    {
        $this->request = $request;
        $this->permission = $permission;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        // $this->validate($this->request, [
        //     'title' => 'required',
        //     'description' => 'required'
        // ]);

        $data = array(
            'typeuser_id' => $this->request->input('typeuser_id'),
            'menu_id' => $this->request->input('menu_id'),
            'is_read' => $this->request->input('is_read'),
            'is_create' => $this->request->input('is_create'),
            'is_update' => $this->request->input('is_update'),
            'is_delete' => $this->request->input('is_delete'),
            'created_at' => ApiHelpers::formatDate()
        );

        list($flag, $id, $msg) = $this->permission->savePermission($data);
        $response = ApiHelpers::createResponse($flag, $msg, array('permissionId' => $id));

        return response()->json($response);
    }

    public function show()
    {
        $req = array(
            'id' => $this->request->id
        );

        list($data, $msg) = $this->permission->getPermission($req);
        $response = ApiHelpers::createResponse(true, $msg, $data);
        return response()->json($response);
    }

    public function update()
    {
        // $this->validate($this->request, [
        //     'title' => 'required',
        //     'description' => 'required'
        // ]);

        $data = array(
            'typeuser_id' => $this->request->get('typeuser_id'),
            'menu_id' => $this->request->get('menu_id'),
            'is_read' => $this->request->get('is_read'),
            'is_create' => $this->request->get('is_create'),
            'is_update' => $this->request->get('is_update'),
            'is_delete' => $this->request->get('is_delete'),
            'created_at' => ApiHelpers::formatDate()
        );

        $id = $this->request->id;
        list($flag, $id, $msg) = $this->permission->savePermission($data, $id);
        $response = ApiHelpers::createResponse($flag, $msg, array('permissionId' => $id));

        return response()->json($response);
    }

    public function destroy()
    {
        list($flag, $msg) = $this->permission->deletePermission($this->request->id);
        $response = ApiHelpers::createResponse($flag, $msg);

        return response()->json($response);
    }
}
