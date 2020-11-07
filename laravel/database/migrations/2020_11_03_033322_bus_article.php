<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class BusArticle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_article', function (Blueprint $table) {
             $table->engine = 'InnoDB';
             $table->charset = 'utf8mb4';
             $table->collation = 'utf8mb4_general_ci';
            // CONTENT
            $table->bigIncrements('id')->nullable(false)->comment('');
			$table->datetime('created_at')->nullable()->default(null)->comment('');
			$table->datetime('updated_at')->nullable()->default(null)->comment('');
			$table->datetime('deleted_at')->nullable()->default(null)->comment('');
			$table->string('title', 100)->nullable()->default(null)->comment('文章标题');
			$table->string('desc', 200)->nullable()->default(null)->comment('文章描述');
			$table->unsignedInteger('author')->nullable()->default(null)->comment('作者ID');
			$table->string('authorName', 100)->nullable()->default(null)->comment('作者名字');
			$table->text('content')->nullable()->comment('文章内容');
			$table->string('tag', 100)->nullable()->default(null)->comment('文章标签');
			$table->string('tagNames', 100)->nullable()->default(null)->comment('标签回显');
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
        Schema::dropIfExists('bus_article');
    }
}
