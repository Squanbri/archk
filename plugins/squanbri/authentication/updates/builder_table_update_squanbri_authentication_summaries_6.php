<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSquanbriAuthenticationSummaries6 extends Migration
{
    public function up()
    {
        Schema::table('squanbri_authentication_summaries', function($table)
        {
            $table->text('education_places')->nullable();
            $table->boolean('is_hidden')->default(false)->change();
        });
    }
    
    public function down()
    {
        Schema::table('squanbri_authentication_summaries', function($table)
        {
            $table->dropColumn('education_places');
            $table->boolean('is_hidden')->default(0)->change();
        });
    }
}
