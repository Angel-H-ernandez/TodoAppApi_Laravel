<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\group_taskController;
use App\Http\Controllers\TaskAgendaController;

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
Route::post('new-task', function(){
    return 'New task';
});

//edit task
Route::put('update-task', function(){
    return 'Update task';
});

//list task for today // or for work space
Route::get('list-tasks', function(){
    return 'List tasks';
});

//delete task
Route::delete('delete-task', function(){
    return 'Delete task';
});

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
