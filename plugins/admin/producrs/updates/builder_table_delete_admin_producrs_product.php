<?php namespace Admin\Producrs\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeleteAdminProducrsProduct extends Migration
{
    public function up()
    {
        Schema::dropIfExists('admin_producrs_product');
    }
    
    public function down()
    {
        Schema::create('admin_producrs_product', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('desc', 191)->nullable();
            $table->string('price', 191)->nullable();
            $table->string('title', 191)->nullable();
        });
    }
}
