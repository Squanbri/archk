<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSquanbriAuthenticationSummaries2 extends Migration
{
    public function up()
    {
        Schema::table('squanbri_authentication_summaries', function($table)
        {
            $table->renameColumn('sphere_proffesion', 'industrial');
        });
    }
    
    public function down()
    {
        Schema::table('squanbri_authentication_summaries', function($table)
        {
            $table->renameColumn('industrial', 'sphere_proffesion');
        });
    }
}
