<?php

namespace App\Http\Controllers\Api;

use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller
{
    public function index(){

        $persons=Person::all();
        if ($persons->count()>0){
            return response()->json([
                'status'=> 200,
                'persons'=>$persons,
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
            'email_address'=>'required|max:100',
            'password'=>'required|max:100',
        ]);

        if($validator->fails()){

            return response()->json([
                'status'=> 422,
                'errors'=> $validator->messages()

            ],422);
        }else{

            $person = Person::create([
                'email_address'=>$request->email_address,
                'password'=>$request->password,
            ]);
            if($person){
                return response()->json([
                    'status'=> 200,
                    'message'=> 'Person Created Sucessfully'
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
        $person= Person::find($id);
        if($person){
            return response()->json([
                'status'=> 200,
                'person'=> $person
            ],200);
        }else{
            return response()->json([
                'status'=> 404,
                'message'=> 'No Such Person Found'
            ],404);
        }
    }
    public function edit($id){
        $person= Person::find($id);
        if($person){
            return response()->json([
                'status'=> 200,
                'person'=> $person
            ],200);
        }else{
            return response()->json([
                'status'=> 404,
                'message'=> 'No Such Person Found'
            ],404);
        }
    }
    public function update(Request $request,int$id){
        $validator=Validator::make($request->all(),[
            'email_address'=>'required|max:100',
            'password'=>'required|max:100',
        ]);

        if($validator->fails()){

            return response()->json([
                'status'=> 422,
                'errors'=> $validator->messages()

            ],422);
        }else{
            $person = Person::find($id);
            
            if($person){

                $person ->update([
                    'email_address'=>$request->email_address,
                    'password'=>$request->password,
                ]);
                return response()->json([
                    'status'=> 200,
                    'message'=> 'Person Updated Sucessfully'
                ],200);
            }
            else{
                return response()->json([
                    'status'=> 404,
                    'message'=> 'No such Person'
                ],404);
            }
        }
    }

    public function destroy($id){
        $person=Person::find($id);
        if($person){
            $person->delete();

            return response()->json([
                'status'=> 200,
                'message'=> 'Person Deleted Sucessfully'
            ],200);

        }else{
            return response()->json([
                'status'=> 404,
                'message'=> 'No such Person'
            ],404);
        }

    }
}
