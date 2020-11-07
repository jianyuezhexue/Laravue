<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SysDictionaryDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_dictionary_details', function (Blueprint $table) {
             $table->engine = 'InnoDB';
             $table->charset = 'utf8mb4';
             $table->collation = 'utf8mb4_general_ci';
            // CONTENT
            $table->bigIncrements('id')->nullable(false)->comment('');
			$table->datetime('created_at')->nullable()->default(null)->comment('');
			$table->datetime('updated_at')->nullable()->default(null)->comment('');
			$table->datetime('deleted_at')->nullable()->default(null)->comment('');
			$table->string('label', 191)->nullable()->default(null)->comment('展示值');
			$table->bigInteger('value')->nullable()->default(null)->comment('字典值');
			$table->boolean('status')->nullable()->default(null)->comment('启用状态');
			$table->bigInteger('sort')->nullable()->default(null)->comment('排序标记');
			$table->unsignedBigInteger('sys_dictionary_id')->nullable()->default(null)->comment('关联标记');
			$table->index('deleted_at', 'idx_sys_dictionary_details_deleted_at');
			
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_dictionary_details');
    }
}
