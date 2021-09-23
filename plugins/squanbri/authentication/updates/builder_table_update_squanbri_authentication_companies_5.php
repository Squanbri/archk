<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSquanbriAuthenticationCompanies5 extends Migration
{
    public function up()
    {
        Schema::table('squanbri_authentication_companies', function($table)
        {
            $table->renameColumn('descriptions', 'description');
        });
    }
    
    public function down()
    {
        Schema::table('squanbri_authentication_companies', function($table)
        {
            $table->renameColumn('description', 'descriptions');
        });
    }
}
