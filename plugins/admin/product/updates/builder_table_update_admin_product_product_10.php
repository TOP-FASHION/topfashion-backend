<?php namespace Admin\Product\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAdminProductProduct10 extends Migration
{
    public function up()
    {
        Schema::table('admin_product_product', function($table)
        {
            $table->integer('sku')->nullable();
            $table->text('description')->nullable();
            $table->string('availablesizes')->nullable();
            $table->string('style')->nullable();
            $table->integer('installments')->nullable();
            $table->string('currencyid')->nullable();
            $table->string('currencyformat')->nullable();
            $table->boolean('isfreeshipping')->nullable();
            $table->string('title')->change();
            $table->integer('price')->nullable()->unsigned(false)->default(null)->change();
            $table->string('image')->change();
            $table->dropColumn('desc');
        });
    }
    
    public function down()
    {
        Schema::table('admin_product_product', function($table)
        {
            $table->dropColumn('sku');
            $table->dropColumn('description');
            $table->dropColumn('availablesizes');
            $table->dropColumn('style');
            $table->dropColumn('installments');
            $table->dropColumn('currencyid');
            $table->dropColumn('currencyformat');
            $table->dropColumn('isfreeshipping');
            $table->string('title', 191)->change();
            $table->string('price', 191)->nullable()->unsigned(false)->default(null)->change();
            $table->string('image', 191)->change();
            $table->string('desc', 191)->nullable();
        });
    }
}
