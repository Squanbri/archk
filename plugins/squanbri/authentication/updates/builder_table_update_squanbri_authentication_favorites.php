<?php namespace Squanbri\Authentication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateSquanbriAuthenticationFavorites extends Migration
{
    public function up()
    {
        Schema::table('squanbri_authentication_favorites', function($table)
        {
            $table->string('email', 10);
            $table->dropColumn('user_id');
        });
    }
    
    public function down()
    {
        Schema::table('squanbri_authentication_favorites', function($table)
        {
            $table->dropColumn('email');
            $table->integer('user_id');
        });
    }
}
