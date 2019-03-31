<?php namespace Admin\Product\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAdminProductProduct8 extends Migration
{
    public function up()
    {
        Schema::table('admin_product_product', function($table)
        {
            $table->renameColumn('image', 'pik');
        });
    }
    
    public function down()
    {
        Schema::table('admin_product_product', function($table)
        {
            $table->renameColumn('pik', 'image');
        });
    }
}
