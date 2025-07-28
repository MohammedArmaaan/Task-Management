<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AttendanceInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'present_time',
        'check_in_time',
        'check_out_time',
        'going_time',
        'total_work_seconds',
        'total_break_seconds',
    ];

    protected $casts = [
        'date' => 'date',
        'present_time' => 'datetime',
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime',
        'going_time' => 'datetime',
    ];
    public function user()
{
    return $this->belongsTo(UserInfo::class, 'user_id');
}

}
