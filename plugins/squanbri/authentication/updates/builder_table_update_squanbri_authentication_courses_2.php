<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSquanbriAuthenticationCourses2 extends Migration
{
    public function up()
    {
        Schema::table('squanbri_authentication_courses', function($table)
        {
            $table->string('hours', 191);
        });
    }
    
    public function down()
    {
        Schema::table('squanbri_authentication_courses', function($table)
        {
            $table->dropColumn('hours');
        });
    }
}
