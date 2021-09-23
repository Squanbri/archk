<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSquanbriAuthenticationFavorites2 extends Migration
{
    public function up()
    {
        Schema::table('squanbri_authentication_favorites', function($table)
        {
            $table->string('email', 100)->change();
        });
    }
    
    public function down()
    {
        Schema::table('squanbri_authentication_favorites', function($table)
        {
            $table->string('email', 10)->change();
        });
    }
}
