<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\group_taskController;
use App\Http\Controllers\TaskAgendaController;
use App\Http\Controllers\Task_Controler;

//sing in / sing up___________________________________tengoGITHUB1
Route::post('signin', function(){
    return 'Sign in / sign up';
});

//WORK SPACES_________________________________________
// new workspace from a user
Route::post('/new-work-space', [group_taskController::class, 'store']);

//list all work space from a user
Route::get('/list-work-spaces', [group_taskController::class, 'index']);

//edit name work spaces
Route::put('/update-work-space/{id}', [group_taskController::class, 'update']);

//delete work space
Route::delete('/delete-work-space/{id}', [group_taskController::class, 'destroy']);

//TASK TOOLS______________
//new task
Route::post('/new-task', [Task_Controler::class, 'store']);

//edit task
Route::put('/update-task/{id}', [Task_Controler::class, 'update']);

Route::get('/show-task/{id}', [Task_Controler::class, 'show']);

//list task for today // or for work space
Route::get('/list-tasks-group-space-is_completed/{id_space_work}', [Task_Controler::class, 'task_is_completed_space_work']);


Route::get('/list-task-is_completed-today', [Task_Controler::class, 'task_is_completed_today']);

//delete task
Route::delete('/delete-task/{id}', [Task_Controler::class, 'destroy']);

//SUBTASK___________________________________________

//add subtask to task
Route::post('new-subtask', function(){
    return 'New subtask';
});

//delete subtask from task
Route::delete('delete-subtask', function(){
    return 'Delete subtask';
});

//Checked / unchecked task
Route::post('update-status-completed', function(){
    return 'Update status completed';
});

//list tasks completeds
Route::get('list-tasks-completed', function(){
    return 'List tasks completed';
});

//AGENDA_______________________________________
Route::post('/new-task-agenda', [TaskAgendaController::class, 'store']);

Route::get('/get-task-agenda/{id}', [TaskAgendaController::class, 'show']);

Route::delete('/delete-task-agenda/{id}', [TaskAgendaController::class, 'destroy']);

Route::put('/update-task-agenda/{id}', [TaskAgendaController::class, 'update']);
