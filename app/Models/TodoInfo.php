<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TodoInfo extends Model
{
    protected $table = 'todo_infos';  // Specify the correct table name
    protected $fillable = ['task', 'is_done'];
}
