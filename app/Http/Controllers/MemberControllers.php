<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\models\Members\Members;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class MemberControllers extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        return Members::all();
    }


    public function create(Request $request, Members $members)
    {
        // dd($request);
        $this->validate($request, [
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required',
            // 'status' => 'required|numeric',
            'type_user' => 'required|numeric',
            // 'gender' => 'required|numeric'
        ]);

        $data = array(
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            // 'status' => $request->input('status'),
            'type_user' => $request->input('type_user'),
            'created_at' => ApiHelpers::formatDate(),
            // 'gender' => $request->input('gender')
        );

        list($result, $msg) = $members->getMembers(array('email' => $request->email));
        
        if(!$result->isEmpty()){
            $msg = __('general.exists');
            $result = array();
        }else{
            list($flag, $id, $msg) = $members->saveMember($data);
            
            $result = array(
                'STATUS' => $flag,
                'MEMBER_ID' => $id
            ); 
    
            if(!$flag){
                //Your Code    
            }
        }

        $response = ApiHelpers::createResponse($flag, $msg, $result);
        return response()->json($response, 200);
    }

    public function show(Request $request, Members $members)
    {
        $param = array('id' => $request->id, 'name' => $request->name, 'email' => $request->email);
        $page = $this->request->page;
        list($result, $msg) = $members->getMembers($param, $page);
        $response = ApiHelpers::createResponse(true, $msg, $result);
        
        return response()->json($response, 200);
    }

    public function update(Request $request, Members $members)
    {
        $data = array(
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            // 'password' => Hash::make($request->input('password')),
            // 'status' => $request->input('status'),
            // 'type_user' => $request->input('type_user'),
            // 'created_at' => ApiHelpers::formatDate(),
            // 'gender' => $request->input('gender')
        );

        list($uflag, $uid, $umsg) = $members->saveMember($data, $request->id);
        $data['memberId'] = $uid;
        $response = ApiHelpers::createResponse($uflag, $umsg, $data);
        return response()->json($response);
    }

    public function destroy(Request $request, Members $members)
    {
        list($flag, $msg) = $members->deleteMember($request->id);
        $response = ApiHelpers::createResponse($flag, $msg, '');
        
        return response()->json($response);
    }
}
