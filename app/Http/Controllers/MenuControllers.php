<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelpers;
use App\models\Menu\Menu;
use Illuminate\Http\Request;

class MenuControllers extends Controller
{
    function __construct(Request $request, Menu $menu)
    {
        $this->request = $request;
        $this->menu = $menu;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        $this->validate($this->request, [
            'menu' => 'required'
        ]);

        $data = array(
            'menu' => $this->request->input('menu'),
            'created_at' => ApiHelpers::formatDate()
        );

        list($flag, $id, $msg) = $this->menu->saveMenu($data);
        $response = ApiHelpers::createResponse($flag, $msg, array('menuId' => $id));

        return response()->json($response);
    }

    public function show()
    {
        $req = array(
            'id' => $this->request->id,
            'menu' => $this->request->title
        );

        list($data, $msg) = $this->menu->getMenu($req);
        $response = ApiHelpers::createResponse(true, $msg, $data);
        return response()->json($response);
    }

    public function update()
    {
        $this->validate($this->request, [
            'menu' => 'required'
        ]);

        $data = array(
            'menu' => $this->request->get('menu'),
            'created_at' => ApiHelpers::formatDate()
        );

        $id = $this->request->id;
        list($flag, $id, $msg) = $this->menu->saveMenu($data, $id);
        $response = ApiHelpers::createResponse($flag, $msg, array('menuId' => $id));

        return response()->json($response);
    }

    public function destroy()
    {
        list($flag, $msg) = $this->menu->deleteMenu($this->request->id);
        $response = ApiHelpers::createResponse($flag, $msg);

        return response()->json($response);
    }
}
