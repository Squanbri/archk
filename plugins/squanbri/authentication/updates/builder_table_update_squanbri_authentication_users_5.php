<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSquanbriAuthenticationUsers5 extends Migration
{
    public function up()
    {
        Schema::table('squanbri_authentication_users', function($table)
        {
            $table->boolean('activate')->default(false)->change();
        });
    }
    
    public function down()
    {
        Schema::table('squanbri_authentication_users', function($table)
        {
            $table->boolean('activate')->default(0)->change();
        });
    }
}
