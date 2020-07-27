<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelpers;
use App\models\SocialMedia\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaControllers extends Controller
{
    
    function __construct(Request $request, SocialMedia $socialmedia)
    {
        $this->request = $request;
        $this->socialmedia = $socialmedia;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        $this->validate($this->request, [
            'social_media' => 'required',
            'link' => 'required'
        ]);

        $data = array(
            'member_id' => $this->request->input('member_id'),
            'social_media' => $this->request->input('social_media'),
            'created_at' => ApiHelpers::formatDate(),
            'link' => $this->request->get('link')
        );

        list($flag, $id, $msg) = $this->socialmedia->saveSocialMedia($data);
        $response = ApiHelpers::createResponse($flag, $msg, array('socialmediaId' => $id));

        return response()->json($response);
    }

    public function show()
    {
        $req = array(
            'id' => $this->request->id,
            'social_media' => $this->request->social_media
        );

        list($data, $msg) = $this->socialmedia->getSocialMedia($req);
        $response = ApiHelpers::createResponse(true, $msg, $data);
        return response()->json($response);
    }

    public function update()
    {
        $this->validate($this->request, [
            'social_media' => 'required',
            'link' => 'required'
        ]);

        $data = array(
            'member_id' => $this->request->get('member_id'),
            'social_media' => $this->request->get('social_media'),
            'created_at' => ApiHelpers::formatDate(),
            'link' => $this->request->get('link')
        );

        $id = $this->request->id;
        list($flag, $id, $msg) = $this->socialmedia->saveSocialMedia($data, $id);
        $response = ApiHelpers::createResponse($flag, $msg, array('socialmediaId' => $id));

        return response()->json($response);
    }

    public function destroy()
    {
        list($flag, $msg) = $this->socialmedia->deleteSocialMedia($this->request->id);
        $response = ApiHelpers::createResponse($flag, $msg);

        return response()->json($response);
    }
}
