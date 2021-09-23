<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSquanbriAuthenticationSummaries7 extends Migration
{
    public function up()
    {
        Schema::table('squanbri_authentication_summaries', function($table)
        {
            $table->text('experience_places')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('squanbri_authentication_summaries', function($table)
        {
            $table->dropColumn('experience_places');
        });
    }
}
