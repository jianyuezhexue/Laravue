<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SysUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_users', function (Blueprint $table) {
             $table->engine = 'InnoDB';
             $table->charset = 'utf8mb4';
             $table->collation = 'utf8mb4_general_ci';
            // CONTENT
            $table->bigIncrements('id')->nullable(false)->comment('');
			$table->datetime('created_at')->nullable()->default(null)->comment('');
			$table->datetime('updated_at')->nullable()->default(null)->comment('');
			$table->datetime('deleted_at')->nullable()->default(null)->comment('');
			$table->string('uuid', 191)->nullable()->default(null)->comment('用户UUID');
			$table->string('username', 191)->nullable()->default(null)->comment('用户登录名');
			$table->string('password', 191)->nullable()->default(null)->comment('用户登录密码');
			$table->string('nick_name', 191)->nullable()->default('系统用户')->comment('用户昵称');
			$table->string('header_img', 191)->nullable()->default('http://qmplusimg.henrongyi.top/head.png')->comment('用户头像');
			$table->string('authority_id', 90)->nullable()->default(888)->comment('用户角色ID');
			$table->index('deleted_at', 'idx_sys_users_deleted_at');
			
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_users');
    }
}
