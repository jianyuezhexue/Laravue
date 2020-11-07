<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SysBaseMenuParameters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_base_menu_parameters', function (Blueprint $table) {
             $table->engine = 'InnoDB';
             $table->charset = 'utf8mb4';
             $table->collation = 'utf8mb4_general_ci';
            // CONTENT
            $table->bigIncrements('id')->nullable(false)->comment('');
			$table->datetime('created_at')->nullable()->default(null)->comment('');
			$table->datetime('updated_at')->nullable()->default(null)->comment('');
			$table->datetime('deleted_at')->nullable()->default(null)->comment('');
			$table->unsignedBigInteger('sys_base_menu_id')->nullable()->default(null)->comment('');
			$table->string('type', 191)->nullable()->default(null)->comment('');
			$table->string('key', 191)->nullable()->default(null)->comment('');
			$table->string('value', 191)->nullable()->default(null)->comment('');
			$table->index('deleted_at', 'idx_sys_base_menu_parameters_deleted_at');
			
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_base_menu_parameters');
    }
}
