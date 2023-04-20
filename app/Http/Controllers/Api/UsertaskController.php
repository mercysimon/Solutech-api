<?php

namespace App\Http\Controllers\Api;

use App\Models\Usertask;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UsertaskController extends Controller
{
    public function index(){
        $usertasks=Usertask::all();
        if($usertasks->count()>0){
            return response()->json([
                'status'=> 200,
                'usertasks'=>$usertasks,
            ],200 );

        }else{

            return response()->json([
                'status'=> 404,
                'message'=>'No Record Found',
            ],404 );
        }
    }
    public function store(Request $request){


        $validator=Validator::make($request->all(),[
            'person_id'=>'required|max:11',
            'task_id'=>'required|max:11',
            'remark'=>'required|max:100',

            
        ]);

        if($validator->fails()){

            return response()->json([
                'status'=> 422,
                'errors'=> $validator->messages()

            ],422);
        }else{

            $usertasks = Usertask::create([
                'person_id'=>$request->person_id,
                'task_id'=>$request->task_id,
                'remark'=>$request->remark,
                'status_id'=>$request->status_id
                
            ]);
            if($usertask){
                return response()->json([
                    'status'=> 200,
                    'message'=> 'Remark Created Sucessfully'
                ],200);
            }
            else{
                return response()->json([
                    'status'=> 500,
                    'message'=> 'Something Went Wrong'
                ],500);
            }
        }
    }
}