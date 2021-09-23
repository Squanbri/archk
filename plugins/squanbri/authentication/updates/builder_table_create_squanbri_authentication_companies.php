<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSquanbriAuthenticationCompanies extends Migration
{
    public function up()
    {
        Schema::create('squanbri_authentication_companies', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('email');
            $table->string('password');
            $table->string('name');
            $table->string('address');
            $table->string('links');
            $table->text('descriptions');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('squanbri_authentication_companies');
    }
}
