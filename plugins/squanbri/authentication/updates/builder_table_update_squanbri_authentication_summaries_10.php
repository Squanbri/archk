<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSquanbriAuthenticationSummaries10 extends Migration
{
    public function up()
    {
        Schema::table('squanbri_authentication_summaries', function($table)
        {
            $table->string('schedule');
        });
    }
    
    public function down()
    {
        Schema::table('squanbri_authentication_summaries', function($table)
        {
            $table->dropColumn('schedule');
        });
    }
}
