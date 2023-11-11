<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class EmployeeAttendance extends Model
{
    use HasFactory;

    /**
     * モデルで使用可能なフィールドの配列
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'attendance_time',
        'is_attendance',
        'next_reset_time',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
