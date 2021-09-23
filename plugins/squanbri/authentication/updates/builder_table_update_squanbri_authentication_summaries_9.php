<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSquanbriAuthenticationSummaries9 extends Migration
{
    public function up()
    {
        Schema::table('squanbri_authentication_summaries', function($table)
        {
            $table->text('experience')->nullable(false)->default('null')->change();
            $table->text('education')->nullable(false)->default('null')->change();
            $table->string('salary', 191)->nullable(false)->default('null')->change();
            $table->string('industrial', 191)->nullable(false)->default('null')->change();
        });
    }
    
    public function down()
    {
        Schema::table('squanbri_authentication_summaries', function($table)
        {
            $table->text('experience')->nullable()->default(null)->change();
            $table->text('education')->nullable()->default(null)->change();
            $table->string('salary', 191)->nullable()->default(null)->change();
            $table->string('industrial', 191)->nullable()->default(null)->change();
        });
    }
}
