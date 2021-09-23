<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSquanbriAuthenticationUsers extends Migration
{
    public function up()
    {
        Schema::create('squanbri_authentication_users', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('email');
            $table->string('password');
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('city')->nullable();
            $table->string('education')->nullable();
            $table->string('sex')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('online')->nullable();
            $table->string('activate')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('squanbri_authentication_users');
    }
}
