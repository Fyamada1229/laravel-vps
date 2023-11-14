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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ユーザーID');
            $table->integer('account_id')->comment('アカウントID');
            $table->string('name')->comment('名前');
            $table->string('email')->comment('メールアドレス')->nullable();
            $table->string('comment', 200)->comment('コメント欄')->nullable();
            $table->string('password')->comment('パスワード');
            $table->integer('admin_flag')->comment('管理者フラグ')->nullable();
            $table->timestamps();

            $table->comment('ユーザーテーブル');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
