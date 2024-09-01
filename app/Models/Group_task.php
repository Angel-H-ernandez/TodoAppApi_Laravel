<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group_task extends Model
{
    use HasFactory;

    protected $table = "group_task"; //the name table
    protected $fillable = [ //the editable columns
        'user_main_id',
        'name',
        'description',

    ];

   /* public function users(){
        return $this->belongsTo(User::class,'user_main_id',);
    }*/
}
