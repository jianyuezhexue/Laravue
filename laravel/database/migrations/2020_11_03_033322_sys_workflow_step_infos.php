<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SysWorkflowStepInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_workflow_step_infos', function (Blueprint $table) {
             $table->engine = 'InnoDB';
             $table->charset = 'utf8mb4';
             $table->collation = 'utf8mb4_general_ci';
            // CONTENT
            $table->bigIncrements('id')->nullable(false)->comment('');
			$table->datetime('created_at')->nullable()->default(null)->comment('');
			$table->datetime('updated_at')->nullable()->default(null)->comment('');
			$table->datetime('deleted_at')->nullable()->default(null)->comment('');
			$table->unsignedBigInteger('sys_workflow_id')->nullable()->default(null)->comment('所属工作流ID');
			$table->boolean('is_start')->nullable()->default(null)->comment('是否是开始流节点');
			$table->string('step_name', 191)->nullable()->default(null)->comment('工作流节点名称');
			$table->double('step_no', 10, 0)->nullable()->default(null)->comment('步骤id （第几步）');
			$table->string('step_authority_id', 191)->nullable()->default(null)->comment('操作者级别id');
			$table->boolean('is_end')->nullable()->default(null)->comment('是否是完结流节点');
			$table->index('deleted_at', 'idx_sys_workflow_step_infos_deleted_at');
			
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_workflow_step_infos');
    }
}
