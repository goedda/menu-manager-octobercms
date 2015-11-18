<?php namespace MarcelParis\Menu\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateMenuTranslatesTable extends Migration
{

    public function up()
    {
        Schema::create('marcelparis_menu_items_translations', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->index();
            $table->string('translation')->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('marcelparis_menu_items_translations');
    }

}
