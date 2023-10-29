<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('ユーザID');
            $table->string('name')->comment('名前');
            $table->dateTime('attendance_time')->comment('出勤時間');
            $table->string('is_attendance')->comment('出勤ステース')->default(0);;
            $table->string('next_reset_time')->comment('出勤判定ステース')->default(0);;
            $table->string('comment')->comment('コメント')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_attendances');
    }
};
