<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSquanbriAuthenticationUsers3 extends Migration
{
    public function up()
    {
        Schema::table('squanbri_authentication_users', function($table)
        {
            $table->string('activate_hash');
        });
    }
    
    public function down()
    {
        Schema::table('squanbri_authentication_users', function($table)
        {
            $table->dropColumn('activate_hash');
        });
    }
}
