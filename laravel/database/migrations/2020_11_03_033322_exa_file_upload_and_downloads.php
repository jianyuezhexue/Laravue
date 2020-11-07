<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ExaFileUploadAndDownloads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exa_file_upload_and_downloads', function (Blueprint $table) {
             $table->engine = 'InnoDB';
             $table->charset = 'utf8mb4';
             $table->collation = 'utf8mb4_general_ci';
            // CONTENT
            $table->bigIncrements('id')->nullable(false)->comment('');
			$table->datetime('created_at')->nullable()->default(null)->comment('');
			$table->datetime('updated_at')->nullable()->default(null)->comment('');
			$table->datetime('deleted_at')->nullable()->default(null)->comment('');
			$table->string('name', 191)->nullable()->default(null)->comment('文件名');
			$table->string('url', 191)->nullable()->default(null)->comment('文件地址');
			$table->string('tag', 191)->nullable()->default(null)->comment('文件标签');
			$table->string('key', 191)->nullable()->default(null)->comment('编号');
			$table->index('deleted_at', 'idx_exa_file_upload_and_downloads_deleted_at');
			
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exa_file_upload_and_downloads');
    }
}
