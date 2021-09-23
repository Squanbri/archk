<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSquanbriAuthenticationCompanies6 extends Migration
{
    public function up()
    {
        Schema::table('squanbri_authentication_companies', function($table)
        {
            $table->renameColumn('sphere_profession', 'industrial');
        });
    }
    
    public function down()
    {
        Schema::table('squanbri_authentication_companies', function($table)
        {
            $table->renameColumn('industrial', 'sphere_profession');
        });
    }
}
