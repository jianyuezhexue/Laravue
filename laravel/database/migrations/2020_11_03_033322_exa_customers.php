<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ExaCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exa_customers', function (Blueprint $table) {
             $table->engine = 'InnoDB';
             $table->charset = 'utf8mb4';
             $table->collation = 'utf8mb4_general_ci';
            // CONTENT
            $table->bigIncrements('id')->nullable(false)->comment('');
			$table->datetime('created_at')->nullable()->default(null)->comment('');
			$table->datetime('updated_at')->nullable()->default(null)->comment('');
			$table->datetime('deleted_at')->nullable()->default(null)->comment('');
			$table->string('customer_name', 191)->nullable()->default(null)->comment('客户名');
			$table->string('customer_phone_data', 191)->nullable()->default(null)->comment('客户手机号');
			$table->unsignedBigInteger('sys_user_id')->nullable()->default(null)->comment('管理ID');
			$table->string('sys_user_authority_id', 191)->nullable()->default(null)->comment('管理角色ID');
			$table->index('deleted_at', 'idx_exa_customers_deleted_at');
			
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exa_customers');
    }
}
