<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelpers;
use App\models\Rate\Rate;
use Illuminate\Http\Request;

class RateControllers extends Controller
{
    
    function __construct(Request $request, Rate $rate)
    {
        $this->request = $request;
        $this->rate = $rate;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        $this->validate($this->request, [
            'rate' => 'required'
        ]);

        $data = array(
            'chapter_id' => $this->request->input('chapter_id'),
            'rate' => $this->request->input('rate'),
            'created_at' => ApiHelpers::formatDate()
        );

        list($flag, $id, $msg) = $this->rate->saveRate($data);
        $response = ApiHelpers::createResponse($flag, $msg, array('rateId' => $id));

        return response()->json($response);
    }

    public function show()
    {
        $req = array(
            'id' => $this->request->id
        );

        list($data, $msg) = $this->rate->getRate($req);
        $response = ApiHelpers::createResponse(true, $msg, $data);
        return response()->json($response);
    }

    public function update()
    {
        $this->validate($this->request, [
            'rate' => 'required'
        ]);

        $data = array(
            'chapter_id' => $this->request->get('chapter_id'),
            'rate' => $this->request->get('rate'),
            'created_at' => ApiHelpers::formatDate()
        );

        $id = $this->request->id;
        list($flag, $id, $msg) = $this->rate->saveRate($data, $id);
        $response = ApiHelpers::createResponse($flag, $msg, array('rateId' => $id));

        return response()->json($response);
    }

    public function destroy()
    {
        list($flag, $msg) = $this->rate->deleteRate($this->request->id);
        $response = ApiHelpers::createResponse($flag, $msg);

        return response()->json($response);
    }
}
