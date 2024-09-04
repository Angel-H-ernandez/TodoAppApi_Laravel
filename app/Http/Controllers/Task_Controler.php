<?php

namespace App\Http\Controllers;

use App\Models\TaskModel;

use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; //to validate request

class Task_Controler extends Controller
{
    //get task from space work of user
    public function task_is_completed_today(Request $request){

        $tasks = TaskModel::join('task_agenda', 'task.task_agenda_id', '=', 'task_agenda.id')
            ->where('task.completed', $request->isCompleted)
            ->where('task_agenda.'.$request->dayOfWeek, '!=', null)
            ->get();

        if($tasks->isEmpty()){
            $data = [
                'message'=>'No task today',
                'status'=>'404'
            ];
            return response()->json($data, 404);
        }

        $data = [
            'tasks'=>$tasks,
            'status'=>'200'
        ];
        return response()->json($data, 200);

    }

    public function task_is_completed_space_work(Request $request, $id_space_work){

        $tasks = TaskModel::where('group_task_id', $id_space_work)
            ->where('completed', $request->isCompleted)
            ->get();

        if($tasks->isEmpty()){
            $data = [
                'message' => 'no task found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            "tasks" => $tasks,
            "status" => 200
        ];
        return response()->json($data, 200);

    }

    public function destroy($id){
        $task = TaskModel::find($id);

        if(!$task){
            $data = [
                'message' => "Task not found !",
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $task->delete();

        $data = [
            'message' => "Task deleted !",
            'status' => 200
        ];
        return response()->json($data, 200);

    }

    public function show($id)
    {
        $task = TaskModel::find($id);

        if(!$task){
            $data = [
                'message' => "Task not found !",
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'task' => $task,
            "status" => 200
        ];
        return response()->json($data, 200);


    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'nullable|max:255',
            'completed' => 'required|boolean',
            'group_task_id' => 'required',
            'progress_percentage' => 'required|integer',
            'duration_time' => 'nullable|integer',
            'assigned_user_id' => 'required',
            'created_by_user_id' => 'required',
        ]);
        if($validator->fails()){
            $data = [
                'message' => 'error in the validation',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $task = TaskModel::create([
            'title' => $request->title,
            'description'=>$request->description,
            'completed' => $request->completed,
            'group_task_id'=>$request->group_task_id,
            'progress_percentage' => $request->progress_percentage,
            'assigned_user_id'=>$request->assigned_user_id,
            'created_by_user_id'=>$request->created_by_user_id,
            'duration_time'=>$request->duration_time,
            'task_agenda_id'=>$request->task_agenda_id

        ]);

        if(!$task){
            $data = [
                'message' => "error while creating task !",
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => "task created !",
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    public function update(Request $request,$id){

        $task = TaskModel::find($id);

        if(!$task){
            $data = [
                'message' => "Task not found !",
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'nullable|max:255',
            'completed' => 'nullable|boolean',
            'group_task_id' => 'required',
            'progress_percentage' => 'nullable|integer',
            'duration' => 'nullable|integer',
            'assigned_user_id' => 'required',
            'created_by_user_id' => 'required',
        ]);
        if($validator->fails()){
            $data = [
                'message' => 'error in the validation',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $task->title = $request->title;
        $task->description = $request->description;
        $task->completed = $request->completed;
        $task->group_task_id = $request->group_task_id;
        $task->progress_percentage = $request->progress_percentage;
        $task->assigned_user_id = $request->assigned_user_id;
        $task->created_by_user_id = $request->created_by_user_id;
        $task->duration_time = $request->duration_time;
        $task->task_agenda_id = $request->task_agenda_id;
        $task->save();

        $data = [
            'message' => "task updated !",
            'status' => 200
        ];
        return response()->json($data, 200);

    }


}
