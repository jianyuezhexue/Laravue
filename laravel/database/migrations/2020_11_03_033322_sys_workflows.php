<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SysWorkflows extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_workflows', function (Blueprint $table) {
             $table->engine = 'InnoDB';
             $table->charset = 'utf8mb4';
             $table->collation = 'utf8mb4_general_ci';
            // CONTENT
            $table->bigIncrements('id')->nullable(false)->comment('');
			$table->datetime('created_at')->nullable()->default(null)->comment('');
			$table->datetime('updated_at')->nullable()->default(null)->comment('');
			$table->datetime('deleted_at')->nullable()->default(null)->comment('');
			$table->string('workflow_nick_name', 191)->nullable()->default(null)->comment('工作流中文名称');
			$table->string('workflow_name', 191)->nullable()->default(null)->comment('工作流英文名称');
			$table->string('workflow_description', 191)->nullable()->default(null)->comment('工作流描述');
			$table->index('deleted_at', 'idx_sys_workflows_deleted_at');
			
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_workflows');
    }
}
