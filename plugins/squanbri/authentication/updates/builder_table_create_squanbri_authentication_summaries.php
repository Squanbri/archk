<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateSquanbriAuthenticationSummaries extends Migration
{
    public function up()
    {
        Schema::create('squanbri_authentication_summaries', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('id')->unsigned();
            $table->string('skills')->nullable();
            $table->text('expirence')->nullable();
            $table->text('education_places')->nullable();
            $table->string('desire_salary')->nullable();
            $table->text('about_me')->nullable();
            $table->text('profession');
            $table->string('sphere_proffesion')->nullable();
            $table->boolean('is_hidden')->default(false);
            $table->primary(['id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('squanbri_authentication_summaries');
    }
}
