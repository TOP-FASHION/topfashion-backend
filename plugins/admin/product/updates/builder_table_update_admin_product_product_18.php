<?php namespace Admin\Product\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAdminProductProduct18 extends Migration
{
    public function up()
    {
        Schema::table('admin_product_product', function($table)
        {
            $table->string('gender', 191)->nullable();
            $table->string('season', 191)->nullable();
            $table->string('type')->nullable();
            $table->renameColumn('installments', 'priceold');
            $table->renameColumn('isfreeshipping', 'publish');
            $table->dropColumn('style');
            $table->dropColumn('gallery');
        });
    }
    
    public function down()
    {
        Schema::table('admin_product_product', function($table)
        {
            $table->dropColumn('gender');
            $table->dropColumn('season');
            $table->dropColumn('type');
            $table->renameColumn('priceold', 'installments');
            $table->renameColumn('publish', 'isfreeshipping');
            $table->string('style', 191)->nullable();
            $table->string('gallery', 191)->nullable();
        });
    }
}
