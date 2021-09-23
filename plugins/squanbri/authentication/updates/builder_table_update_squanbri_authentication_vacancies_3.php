<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSquanbriAuthenticationVacancies3 extends Migration
{
    public function up()
    {
        Schema::table('squanbri_authentication_vacancies', function($table)
        {
            $table->integer('company_id')->unsigned();
        });
    }
    
    public function down()
    {
        Schema::table('squanbri_authentication_vacancies', function($table)
        {
            $table->dropColumn('company_id');
        });
    }
}
