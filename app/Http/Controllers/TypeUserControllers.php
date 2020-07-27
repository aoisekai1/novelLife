<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelpers;
use App\models\TypeUser\TypeUser;
use Illuminate\Http\Request;

class TypeUserControllers extends Controller
{

    function __construct(Request $request, TypeUser $typeuser)
    {
        $this->request = $request;
        $this->typeuser = $typeuser;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        $this->validate($this->request, [
            'name' => 'required'
        ]);

        $data = array(
            'name' => $this->request->input('name'),
            'created_at' => ApiHelpers::formatDate()
        );

        list($flag, $id, $msg) = $this->typeuser->saveTypeUser($data);
        $response = ApiHelpers::createResponse($flag, $msg, array('typeuserId' => $id));

        return response()->json($response);
    }

    public function show()
    {
        $req = array(
            'id' => $this->request->id,
            'name' => $this->request->name
        );

        list($data, $msg) = $this->typeuser->getTypeUser($req);
        $response = ApiHelpers::createResponse(true, $msg, $data);
        return response()->json($response);
    }

    public function update()
    {
        $this->validate($this->request, [
            'name' => 'required'
        ]);

        $data = array(
            'name' => $this->request->get('name'),
            'created_at' => ApiHelpers::formatDate()
        );

        $id = $this->request->id;
        list($flag, $id, $msg) = $this->typeuser->saveTypeUser($data, $id);
        $response = ApiHelpers::createResponse($flag, $msg, array('typeuserId' => $id));

        return response()->json($response);
    }

    public function destroy()
    {
        list($flag, $msg) = $this->typeuser->deleteTypeUser($this->request->id);
        $response = ApiHelpers::createResponse($flag, $msg);

        return response()->json($response);
    }
}
