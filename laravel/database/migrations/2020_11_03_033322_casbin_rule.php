<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CasbinRule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casbin_rule', function (Blueprint $table) {
             $table->engine = 'InnoDB';
             $table->charset = 'utf8mb4';
             $table->collation = 'utf8mb4_general_ci';
            // CONTENT
            $table->string('p_type', 100)->nullable()->default(null)->comment('');
			$table->string('v0', 100)->nullable()->default(null)->comment('');
			$table->string('v1', 100)->nullable()->default(null)->comment('');
			$table->string('v2', 100)->nullable()->default(null)->comment('');
			$table->string('v3', 100)->nullable()->default(null)->comment('');
			$table->string('v4', 100)->nullable()->default(null)->comment('');
			$table->string('v5', 100)->nullable()->default(null)->comment('');
			
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('casbin_rule');
    }
}
