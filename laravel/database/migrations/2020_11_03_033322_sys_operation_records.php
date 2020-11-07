<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SysOperationRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_operation_records', function (Blueprint $table) {
             $table->engine = 'InnoDB';
             $table->charset = 'utf8mb4';
             $table->collation = 'utf8mb4_general_ci';
            // CONTENT
            $table->bigIncrements('id')->nullable(false)->comment('');
			$table->datetime('created_at')->nullable()->default(null)->comment('');
			$table->datetime('updated_at')->nullable()->default(null)->comment('');
			$table->datetime('deleted_at')->nullable()->default(null)->comment('');
			$table->string('ip', 191)->nullable()->default(null)->comment('请求ip');
			$table->string('method', 191)->nullable()->default(null)->comment('请求方法');
			$table->string('path', 191)->nullable()->default(null)->comment('请求路径');
			$table->bigInteger('status')->nullable()->default(null)->comment('请求状态');
			$table->bigInteger('latency')->nullable()->default(null)->comment('延迟');
			$table->string('agent', 191)->nullable()->default(null)->comment('代理');
			$table->string('error_message', 191)->nullable()->default(null)->comment('错误信息');
			$table->string('body', 191)->nullable()->default(null)->comment('请求Body');
			$table->longText('resp')->nullable()->comment('响应Body');
			$table->unsignedBigInteger('user_id')->nullable()->default(null)->comment('用户id');
			$table->index('deleted_at', 'idx_sys_operation_records_deleted_at');
			
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_operation_records');
    }
}
