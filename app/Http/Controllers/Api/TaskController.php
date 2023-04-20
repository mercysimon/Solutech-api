<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index(){
        $tasks=Task::all();
        if($tasks->count()>0){
            return response()->json([
                'status'=> 200,
                'tasks'=>$tasks,
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
            'name'=>'required|max:100',
            'description'=>'required|max:255',
            'status_id'=>'required|max:12',
        ]);

        if($validator->fails()){

            return response()->json([
                'status'=> 422,
                'errors'=> $validator->messages()

            ],422);
        }else{

            $task = Task::create([
                'name'=>$request->name,
                'description'=>$request->description,
                'status_id'=>$request->status_id,
            ]);
            if($task){
                return response()->json([
                    'status'=> 200,
                    'message'=> 'Task Created Sucessfully'
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
        $task= Task::find($id);
        if($task){
            return response()->json([
                'status'=> 200,
                'task'=> $task
            ],200);
        }else{
            return response()->json([
                'status'=> 404,
                'message'=> 'No Such Task Found'
            ],404);
        }
    } 

    public function edit($id){
        $task= Task::find($id);
        if($task){
            return response()->json([
                'status'=> 200,
                'task'=> $task
            ],200);
        }else{
            return response()->json([
                'status'=> 404,
                'message'=> 'No Such Task Found'
            ],404);
        }
    }

    public function update(Request $request,int$id){
        $validator=Validator::make($request->all(),[
            'name'=>'required|max:100',
            'description'=>'required|max:255',
            'status_id'=>'required|max:12',
        ]);

        if($validator->fails()){

            return response()->json([
                'status'=> 422,
                'errors'=> $validator->messages()

            ],422);
        }else{
            $task = Task::find($id);
            
            if($task){

                $task ->update([
                    'name'=>$request->name,
                   'description'=>$request->description,
                    'status_id'=>$request->status_id,
                ]);
                return response()->json([
                    'status'=> 200,
                    'message'=> 'Task Updated Sucessfully'
                ],200);
            }
            else{
                return response()->json([
                    'status'=> 404,
                    'message'=> 'No such Task'
                ],404);
            }
        }
    }

    public function destroy($id){
        $task=Task::find($id);
        if($task){
            $task->delete();

            return response()->json([
                'status'=> 200,
                'message'=> 'Task Deleted Sucessfully'
            ],200);

        }else{
            return response()->json([
                'status'=> 404,
                'message'=> 'No such Task'
            ],404);
        }

    }
}
