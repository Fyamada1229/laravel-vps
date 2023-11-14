<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Departure extends Model
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
        'departure_time',
        'is_departure',
        'next_reset_time',
        'break_minutes',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
