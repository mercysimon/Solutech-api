<?php

namespace App\Http\Controllers\Api;

use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StatusController extends Controller
{
    public function index(){
        $status=Status::all();
        if($status->count()>0){
            return response()->json([
                'status'=> 200,
                'status'=>$status,
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
            'name'=>'required|max:50',
        ]);

        if($validator->fails()){

            return response()->json([
                'status'=> 422,
                'errors'=> $validator->messages()

            ],422);
        }else{

            $status = Status::create([
                'name'=>$request->name,
            ]);
            if($status){
                return response()->json([
                    'status'=> 200,
                    'message'=> 'Status Created Sucessfully'
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
    public function show($id)
    {
        $status= status::find($id);
        if($status){
            return response()->json([
                'status'=> 200,
                'status'=> $status
            ],200);
        }else{
            return response()->json([
                'status'=> 404,
                'message'=> 'No Such Status Found'
            ],404);
        }
    } 
    public function destroy($id){
        $status=Status::find($id);
        if($status){
            $status->delete();

            return response()->json([
                'status'=> 200,
                'message'=> 'Status Deleted Sucessfully'
            ],200);

        }else{
            return response()->json([
                'status'=> 404,
                'message'=> 'No such Status'
            ],404);
        }

    }
}
