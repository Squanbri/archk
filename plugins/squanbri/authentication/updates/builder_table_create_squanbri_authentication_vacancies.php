<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSquanbriAuthenticationVacancies extends Migration
{
    public function up()
    {
        Schema::create('squanbri_authentication_vacancies', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->string('proffesion');
            $table->string('sphere_profession');
            $table->string('salary');
            $table->string('schedule');
            $table->string('skills');
            $table->integer('company');
            $table->string('education');
            $table->string('expirence');
            $table->text('description');
            $table->boolean('is_hidden');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('squanbri_authentication_vacancies');
    }
}
