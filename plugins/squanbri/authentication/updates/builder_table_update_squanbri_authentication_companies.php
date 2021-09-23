<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSquanbriAuthenticationCompanies extends Migration
{
    public function up()
    {
        Schema::table('squanbri_authentication_companies', function($table)
        {
            $table->string('name', 191)->nullable()->change();
            $table->string('address', 191)->nullable()->change();
            $table->string('links', 191)->nullable()->change();
            $table->text('descriptions')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('squanbri_authentication_companies', function($table)
        {
            $table->string('name', 191)->nullable(false)->change();
            $table->string('address', 191)->nullable(false)->change();
            $table->string('links', 191)->nullable(false)->change();
            $table->text('descriptions')->nullable(false)->change();
        });
    }
}
