<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSquanbriAuthenticationVacancies6 extends Migration
{
    public function up()
    {
        Schema::table('squanbri_authentication_vacancies', function($table)
        {
            $table->renameColumn('expirence', 'experience');
        });
    }
    
    public function down()
    {
        Schema::table('squanbri_authentication_vacancies', function($table)
        {
            $table->renameColumn('experience', 'expirence');
        });
    }
}
