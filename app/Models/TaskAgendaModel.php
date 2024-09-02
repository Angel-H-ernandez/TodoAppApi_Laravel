<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskAgendaModel extends Model
{
    use HasFactory;
    public $timestamps = false; // Esto desactiva el manejo automático de timestamps

    protected $table = "task_agenda"; //the name table
    protected $fillable = [ //the editable columns
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday'
    ];
}
