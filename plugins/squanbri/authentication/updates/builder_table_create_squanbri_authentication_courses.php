<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSquanbriAuthenticationCourses extends Migration
{
    public function up()
    {
        Schema::create('squanbri_authentication_courses', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('industry', 191);
            $table->string('profession', 191);
            $table->string('cost', 191);
            $table->string('education', 191);
            $table->string('certificate', 191);
            $table->string('certificate_link', 191)->nullable();
            $table->string('skills', 191);
            $table->text('description');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('squanbri_authentication_courses');
    }
}
