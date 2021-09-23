<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSquanbriAuthenticationCourses3 extends Migration
{
    public function up()
    {
        Schema::table('squanbri_authentication_courses', function($table)
        {
            $table->string('link', 191);
            $table->string('name', 191);
        });
    }
    
    public function down()
    {
        Schema::table('squanbri_authentication_courses', function($table)
        {
            $table->dropColumn('link');
            $table->dropColumn('name');
        });
    }
}
