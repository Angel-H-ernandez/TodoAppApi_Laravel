<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group_task;
use Illuminate\Support\Facades\Validator; //to validate request
class group_taskController extends Controller

//php artisan make:migration nombre_de_tu_migracion
//php artisan migrate
//php artisan make:model TaskAgendaMod
//php artisan make:controller ProductoController

{
    public function index(Request $request){

        $userMainId = $request->query('user_main_id');

        if(!$userMainId){
            $data = [
                'message' => 'user main id is required',
                'status' => 400,
            ];
            return response()->json($data, 400);
        }

       $groupTask = Group_task::where('user_main_id', $userMainId)->get();

       if($groupTask->isEmpty()){ // if workspace doesn't exit return a message
           $data = [ 'message' => 'Work space doesnt found',
               'status' => 200];

           return response()->json($data,404);
       }

       return response()->json($groupTask, 200);
    }

    //for standart the ws used to created or insert they are called sotore
    public function store(Request $request){
        //validate
       $validator =  Validator::make($request->all(),[
            'user_main_id' => 'required',
            'name' => 'required|unique:group_task',
            'description' => 'nullable'
        ]);

       //if it's fail
        if($validator->fails()){
            $data = [
                'message' => 'Error in data validation',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data,400);
        }

        //if it's created
        $groupSpace = Group_task::create([
                'user_main_id' => $request->user_main_id,
                'name' => $request->name,
                'description' => $request->description
            ]

        );

        //when can't create group task
        if(!$groupSpace){
            $data = [
                'message' => 'Error while creating group task',
                'status' => 500
            ];
            return response()->json($data,500);
        }

        //when create group task successfully
        $data = [
            'group_task' => $groupSpace,
            'status' => 201
        ];

        return response()->json($data,201);

    }

    //for standart the methods to return one unique register they are called show
    public function show($id){

        $group_task = Group_task::find($id);

        if(!$group_task){
            $data = [
                'message' => 'Work space doesnt found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'group_task' => $group_task,
            'status' => 200
        ];
        return response()->json($data,200);
    }

    //method to eliminate
    public function destroy($id){
        $group_task = Group_task::find($id);

        if(!$group_task){
            $data = [
                'message' => 'Work space doesnt found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $group_task->delete();

        $data = [
            'message' => 'Work space deleted',
            'status' => 200
        ];
        return response()->json($data,200);
    }

    //the update
    public function update(Request $request, $id){
        $group_task = Group_task::find($id);

        if(!$group_task){
            $data = [
                'message' => 'Work space doesnt found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validate = Validator::make($request->all(),[
            'name' => 'required|unique:group_task',
            'description' => 'nullable'
        ]);

        if($validate->fails()){
            $data = [
                'message' => 'Error in data validation',
                'errors' => $validate->errors(),
                'status' => 400
            ];
            return response()->json($data,400);
        }

        $group_task->name = $request->name;
        $group_task->description = $request->description;

        $group_task->save();

        $data = [
            'group_task' => $group_task,
            'status' => 200
        ];
        return response()->json($data,200);

    }

}
