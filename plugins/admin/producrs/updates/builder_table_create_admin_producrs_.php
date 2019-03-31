<?php namespace Admin\Producrs\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAdminProducrs extends Migration
{
    public function up()
    {
        Schema::create('admin_producrs_', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('price')->nullable();
            $table->string('desc')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('admin_producrs_');
    }
}
