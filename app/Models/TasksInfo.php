<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TasksInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_title',
        'task_description',
        'task_due_date',
        'task_priority',
        'task_status',
        'task_assigned_to',
        'task_created_by'
    ];

    public function assignee()
    {
        return $this->belongsTo(UserInfo::class, 'task_assigned_to');
    }

    public function creator()
    {
        return $this->belongsTo(UserInfo::class, 'task_created_by');
    }
}