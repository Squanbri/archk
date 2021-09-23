<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSquanbriAuthenticationSummaries11 extends Migration
{
    public function up()
    {
        Schema::table('squanbri_authentication_summaries', function($table)
        {
            $table->renameColumn('industrial', 'industry');
        });
    }
    
    public function down()
    {
        Schema::table('squanbri_authentication_summaries', function($table)
        {
            $table->renameColumn('industry', 'industrial');
        });
    }
}
