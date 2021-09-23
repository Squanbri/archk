<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSquanbriAuthenticationFavorites extends Migration
{
    public function up()
    {
        Schema::create('squanbri_authentication_favorites', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('type');
            $table->integer('target_id');
            $table->integer('user_id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('squanbri_authentication_favorites');
    }
}
