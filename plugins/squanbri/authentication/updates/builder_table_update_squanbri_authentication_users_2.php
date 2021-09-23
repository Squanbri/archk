<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSquanbriAuthenticationUsers2 extends Migration
{
    public function up()
    {
        Schema::table('squanbri_authentication_users', function($table)
        {
            $table->dropColumn('education');
        });
    }
    
    public function down()
    {
        Schema::table('squanbri_authentication_users', function($table)
        {
            $table->string('education', 191)->nullable();
        });
    }
}
