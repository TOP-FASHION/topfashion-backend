<?php namespace Admin\Product\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAdminProductProduct13 extends Migration
{
    public function up()
    {
        Schema::table('admin_product_product', function($table)
        {
            $table->string('image', 191)->nullable()->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('admin_product_product', function($table)
        {
            $table->integer('image')->nullable()->unsigned(false)->default(null)->change();
        });
    }
}
