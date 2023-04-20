<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usertask extends Model
{
    use HasFactory;
     protected $table='usertasks';

     protected $fillable=[
        'person_id',
        'task_id',
        'due_date',
        'start_time',
        'end_time',
        'remark',
        'status_id'
     ];

    

}
