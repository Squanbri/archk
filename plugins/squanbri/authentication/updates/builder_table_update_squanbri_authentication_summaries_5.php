<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSquanbriAuthenticationSummaries5 extends Migration
{
    public function up()
    {
        Schema::table('squanbri_authentication_summaries', function($table)
        {
            $table->renameColumn('education_places', 'education');
        });
    }
    
    public function down()
    {
        Schema::table('squanbri_authentication_summaries', function($table)
        {
            $table->renameColumn('education', 'education_places');
        });
    }
}
