<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelpers;
use App\models\Chapter\Chapter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChapterControllers extends Controller
{
    public function __construct(Request $request, Chapter $chapter)
    {
        $this->request = $request;
        $this->chapter = $chapter;
    }
    
    public function index()
    {
        //
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
            'publish' => $this->request->input('publish'),
            'novel_id' => $this->request->get('novel_id'),
            'draft' => $this->request->input('draft') 
        );

        list($flag, $id, $msg) = $this->chapter->saveChapter($data);
        $response = ApiHelpers::createResponse($flag, $msg, array('chapterId' => $id));
        
        return response()->json($response);
    }
    public function show()
    {
        $req = array(
            'id' => $this->request->id, 
            'title' => $this->request->title
        );
        $page = $this->request->page;
        
        list($data, $msg) = $this->chapter->getChapter($req, $page);
        $response = ApiHelpers::createResponse(true, $msg, $data);
        return response()->json($response);
    }
    
    public function update(Chapter $chapter)
    {
        $this->validate($this->request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        $data = array(
            'title' => $this->request->get('title'),
            'description' => $this->request->get('description'),
            'created_at' => ApiHelpers::formatDate(),
            'publish' => $this->request->get('publish'),
            'novel_id' => $this->request->get('novel_id'),
            'draft' => $this->request->get('draft')
        );
        
        $id = $this->request->id;
        list($flag, $id, $msg) = $this->chapter->saveChapter($data, $id);
        $response = ApiHelpers::createResponse($flag, $msg, array('chapterId' => $id));
        
        return response()->json($response);
    }

    public function destroy()
    {
        list($flag, $msg) = $this->chapter->deleteChapter($this->request->id);
        $response = ApiHelpers::createResponse($flag, $msg);

        return response()->json($response);
    }
}
