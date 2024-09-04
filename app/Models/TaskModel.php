<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskModel extends Model
{
    use HasFactory;
    protected $table = 'task';
    protected $fillable = [
        'title',
        'description',
        'completed',
        'created_at',
        'updated_at',
        'group_task_id',
        'assigned_user_id',
        'priority',
        'progress_percentage',
        'duration_time',
        'created_by_user_id',
        'task_agenda_id',
    ];
}
