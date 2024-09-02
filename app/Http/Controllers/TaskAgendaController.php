<?php

namespace App\Http\Controllers;

use App\Models\Group_task;
use App\Models\TaskAgendaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskAgendaController extends Controller
{


    public function store(Request $request){
        //validate
        $validator =  Validator::make($request->all(),[
            'monday' => 'nullable',
            'tuesday' => 'nullable',
            'wednesday' => 'nullable',
            'thursday' => 'nullable',
            'friday' => 'nullable',
            'saturday' => 'nullable',
            'sunday' => 'nullable',
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
        $task_agenda = TaskAgendaModel::create([

                'monday' => $request->monday,
                'tuesday'=> $request->tuesday,
                'wednesday' => $request->wednesday,
                'thursday' => $request->thursday,
                'friday' => $request->friday,
                'saturday' => $request->saturday,
                'sunday' => $request->sunday,
            ]

        );

        //when can't create group task
        if(!$task_agenda){
            $data = [
                'message' => 'Error while creating task agenda',
                'status' => 500
            ];
            return response()->json($data,500);
        }

        //when create group task successfully
        $data = [
            'task_agenda' => $task_agenda,
            'status' => 201
        ];

        return response()->json($data,201);
    }

    public function show($id){

        $task_ageda = TaskAgendaModel::find($id);

        if(!$task_ageda){
            $data = [
                'message' => 'task agenda doesnt found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'task_agenda' => $task_ageda,
            'status' => 200
        ];
        return response()->json($data,200);
    }

    public function update(Request $request, $id){
        $task_agenda = TaskAgendaModel::find($id);

        if(!$task_agenda){
            $data = [
                'message' => 'task agenda doesnt found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validate = Validator::make($request->all(),[
            'monday' => 'nullable',
            'tuesday' => 'nullable',
            'wednesday' => 'nullable',
            'thursday' => 'nullable',
            'friday' => 'nullable',
            'saturday' => 'nullable',
            'sunday' => 'nullable',

        ]);

        if($validate->fails()){
            $data = [
                'message' => 'Error in data validation',
                'errors' => $validate->errors(),
                'status' => 400
            ];
            return response()->json($data,400);
        }

        $task_agenda->monday = $request->monday;
        $task_agenda->tuesday = $request->tuesday;
        $task_agenda->wednesday = $request->wednesday;
        $task_agenda->thursday = $request->thursday;
        $task_agenda->friday = $request->friday;
        $task_agenda->saturday = $request->saturday;
        $task_agenda->sunday = $request->sunday;

        $task_agenda->save();

        $data = [
            'task_agenda' => $task_agenda,
            'status' => 200
        ];
        return response()->json($data,200);


    }

    public function destroy($id){
        $task_agenda = TaskAgendaModel::find($id);

        if(!$task_agenda){
            $data = [
                'message' => 'Task agenda doesnt found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $task_agenda->delete();

        $data = [
            'message' => 'Task agenda deleted',
            'status' => 200
        ];
        return response()->json($data,200);
    }
}
