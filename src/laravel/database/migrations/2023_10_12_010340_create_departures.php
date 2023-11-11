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
        Schema::create('departures', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->comment('ユーザID');
            $table->string('name')->comment('名前');
            $table->dateTime('departure_time')->comment('退勤時間');
            $table->string('is_departure')->comment('退勤判定')->default(0);
            $table->string('next_reset_time')->comment('退勤判定ステース')->default(0);
            $table->integer('break_minutes')->default(0);
            $table->string('comment')->comment('コメント')->nullable();
            $table->timestamps();

            $table->comment('退勤テーブル');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departures');
    }
};
