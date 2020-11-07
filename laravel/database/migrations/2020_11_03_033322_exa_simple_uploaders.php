<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ExaSimpleUploaders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exa_simple_uploaders', function (Blueprint $table) {
             $table->engine = 'InnoDB';
             $table->charset = 'utf8mb4';
             $table->collation = 'utf8mb4_general_ci';
            // CONTENT
            $table->string('chunk_number', 191)->nullable()->default(null)->comment('当前切片标记');
			$table->string('current_chunk_size', 191)->nullable()->default(null)->comment('当前切片容量');
			$table->string('current_chunk_path', 191)->nullable()->default(null)->comment('切片本地路径');
			$table->string('total_size', 191)->nullable()->default(null)->comment('总容量');
			$table->string('identifier', 191)->nullable()->default(null)->comment('文件标识（md5）');
			$table->string('filename', 191)->nullable()->default(null)->comment('文件名');
			$table->string('total_chunks', 191)->nullable()->default(null)->comment('切片总数');
			$table->boolean('is_done')->nullable()->default(null)->comment('是否上传完成');
			$table->string('file_path', 191)->nullable()->default(null)->comment('文件本地路径');
			
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exa_simple_uploaders');
    }
}
