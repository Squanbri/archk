<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSquanbriAuthenticationCompanies8 extends Migration
{
    public function up()
    {
        Schema::table('squanbri_authentication_companies', function($table)
        {
            $table->string('activate_hash');
        });
    }
    
    public function down()
    {
        Schema::table('squanbri_authentication_companies', function($table)
        {
            $table->dropColumn('activate_hash');
        });
    }
}
