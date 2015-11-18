<?php namespace MarcelParis\Menu\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateMenusTable extends Migration
{

    public function up()
    {
        Schema::create('marcelparis_menus', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->index();
            $table->boolean('is_enabled')->unsigned()->nullable();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('url')->nullable();
            $table->text('items');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('marcelparis_menus');
    }

}
