<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SysDataAuthorityId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_data_authority_id', function (Blueprint $table) {
             $table->engine = 'InnoDB';
             $table->charset = 'utf8mb4';
             $table->collation = 'utf8mb4_general_ci';
            // CONTENT
            $table->string('sys_authority_authority_id', 90)->nullable(false)->comment('角色ID');
			$table->string('data_authority_id_authority_id', 90)->nullable(false)->comment('角色ID');
			$table->primary(['sys_authority_authority_id','data_authority_id_authority_id']);
			
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_data_authority_id');
    }
}
