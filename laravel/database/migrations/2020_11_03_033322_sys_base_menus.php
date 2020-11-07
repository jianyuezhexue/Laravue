<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SysBaseMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_base_menus', function (Blueprint $table) {
             $table->engine = 'InnoDB';
             $table->charset = 'utf8mb4';
             $table->collation = 'utf8mb4_general_ci';
            // CONTENT
            $table->bigIncrements('id')->nullable(false)->comment('');
			$table->datetime('created_at')->nullable()->default(null)->comment('');
			$table->datetime('updated_at')->nullable()->default(null)->comment('');
			$table->datetime('deleted_at')->nullable()->default(null)->comment('');
			$table->unsignedBigInteger('menu_level')->nullable()->default(null)->comment('');
			$table->string('parent_id', 191)->nullable()->default(null)->comment('父菜单ID');
			$table->string('path', 191)->nullable()->default(null)->comment('路由path');
			$table->string('name', 191)->nullable()->default(null)->comment('路由name');
			$table->boolean('hidden')->nullable()->default(null)->comment('是否在列表隐藏');
			$table->string('component', 191)->nullable()->default(null)->comment('对应前端文件路径');
			$table->bigInteger('sort')->nullable()->default(null)->comment('排序标记');
			$table->boolean('keep_alive')->nullable()->default(null)->comment('附加属性');
			$table->boolean('default_menu')->nullable()->default(null)->comment('附加属性');
			$table->string('title', 191)->nullable()->default(null)->comment('附加属性');
			$table->string('icon', 191)->nullable()->default(null)->comment('附加属性');
			$table->index('deleted_at', 'idx_sys_base_menus_deleted_at');
			
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_base_menus');
    }
}
