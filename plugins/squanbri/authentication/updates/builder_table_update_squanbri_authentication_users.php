<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSquanbriAuthenticationUsers extends Migration
{
    public function up()
    {
        Schema::table('squanbri_authentication_users', function($table)
        {
            $table->string('online', 191)->default('false')->change();
            $table->string('activate', 191)->default('false')->change();
        });
    }
    
    public function down()
    {
        Schema::table('squanbri_authentication_users', function($table)
        {
            $table->string('online', 191)->default(null)->change();
            $table->string('activate', 191)->default(null)->change();
        });
    }
}
