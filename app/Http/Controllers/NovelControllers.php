<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelpers;
use App\models\Novels\Novels;
use Illuminate\Http\Request;

class NovelControllers extends Controller
{
    function __construct(Request $request, Novels $novel)
    {
        $this->request = $request;
        $this->novel = $novel;
    }
   
    public function index()
    {
         
    }

    public function create()
    {
        $this->validate($this->request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        $data = array(
            'title' => $this->request->input('title'),
            'description' => $this->request->input('description'),
            'created_at' => ApiHelpers::formatDate(),
            'genre_id' => $this->request->get('novel_id')
        );

        list($flag, $id, $msg) = $this->novel->saveNovel($data);
        $response = ApiHelpers::createResponse($flag, $msg, array('novelId' => $id));

        return response()->json($response);
    }

    public function show()
    {
        $req = array(
            'id' => $this->request->id,
            'title' => $this->request->title,
            'genre' => $this->request->genre
        );

        $page = $this->request->page;

        list($data, $msg) = $this->novel->getNovels($req, $page);
        $response = ApiHelpers::createResponse(true, $msg, $data);
        return response()->json($response);   
    }

    public function update()
    {
        $this->validate($this->request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        $data = array(
            'title' => $this->request->get('title'),
            'description' => $this->request->get('description'),
            'created_at' => ApiHelpers::formatDate(),
            'genre_id' => $this->request->get('novel_id')
        );

        $id = $this->request->id;
        list($flag, $id, $msg) = $this->novel->saveNovel($data, $id);
        $response = ApiHelpers::createResponse($flag, $msg, array('novelId' => $id));

        return response()->json($response);
    }

    public function destroy()
    {
        list($flag, $msg) = $this->novel->deleteNovel($this->request->id);
        $response = ApiHelpers::createResponse($flag, $msg);

        return response()->json($response);
    }
}
