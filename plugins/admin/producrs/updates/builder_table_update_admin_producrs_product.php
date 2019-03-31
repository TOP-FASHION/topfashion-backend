<?php namespace Admin\Producrs\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAdminProducrsProduct extends Migration
{
    public function up()
    {
        Schema::rename('admin_producrs_', 'admin_producrs_product');
        Schema::table('admin_producrs_product', function($table)
        {
            $table->increments('id')->unsigned(false)->change();
            $table->string('desc')->change();
            $table->string('price')->change();
            $table->string('title')->change();
        });
    }
    
    public function down()
    {
        Schema::rename('admin_producrs_product', 'admin_producrs_');
        Schema::table('admin_producrs_', function($table)
        {
            $table->increments('id')->unsigned()->change();
            $table->string('desc', 191)->change();
            $table->string('price', 191)->change();
            $table->string('title', 191)->change();
        });
    }
}
