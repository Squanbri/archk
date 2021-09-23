<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSquanbriAuthenticationVacancies extends Migration
{
    public function up()
    {
        Schema::table('squanbri_authentication_vacancies', function($table)
        {
            $table->integer('id')->unsigned()->change();
            $table->text('description')->nullable()->change();
            $table->primary(['id']);
        });
    }
    
    public function down()
    {
        Schema::table('squanbri_authentication_vacancies', function($table)
        {
            $table->dropPrimary(['id']);
            $table->integer('id')->unsigned(false)->change();
            $table->text('description')->nullable(false)->change();
        });
    }
}
