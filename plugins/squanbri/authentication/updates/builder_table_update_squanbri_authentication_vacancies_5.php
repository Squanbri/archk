<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSquanbriAuthenticationVacancies5 extends Migration
{
    public function up()
    {
        Schema::table('squanbri_authentication_vacancies', function($table)
        {
            $table->string('city');
        });
    }
    
    public function down()
    {
        Schema::table('squanbri_authentication_vacancies', function($table)
        {
            $table->dropColumn('city');
        });
    }
}
