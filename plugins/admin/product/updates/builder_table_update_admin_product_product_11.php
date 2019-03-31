<?php namespace Admin\Product\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAdminProductProduct11 extends Migration
{
    public function up()
    {
        Schema::table('admin_product_product', function($table)
        {
            $table->string('gallery')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('admin_product_product', function($table)
        {
            $table->dropColumn('gallery');
        });
    }
}
