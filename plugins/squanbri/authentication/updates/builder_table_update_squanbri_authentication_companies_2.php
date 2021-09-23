<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSquanbriAuthenticationCompanies2 extends Migration
{
    public function up()
    {
        Schema::table('squanbri_authentication_companies', function($table)
        {
            $table->string('online')->default('false');
            $table->boolean('activate')->default(false);
        });
    }
    
    public function down()
    {
        Schema::table('squanbri_authentication_companies', function($table)
        {
            $table->dropColumn('online');
            $table->dropColumn('activate');
        });
    }
}
