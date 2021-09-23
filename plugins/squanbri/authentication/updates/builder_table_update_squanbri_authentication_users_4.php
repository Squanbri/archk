<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSquanbriAuthenticationUsers4 extends Migration
{
    public function up()
    {
        Schema::table('squanbri_authentication_users', function($table)
        {
            $table->boolean('activate')->nullable()->unsigned(false)->default(false)->change();
        });
    }
    
    public function down()
    {
        Schema::table('squanbri_authentication_users', function($table)
        {
            $table->string('activate', 191)->nullable()->unsigned(false)->default('false')->change();
        });
    }
}
