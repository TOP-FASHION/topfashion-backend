<?php namespace Admin\Product\Models;

use Model;

/**
 * Model
 */
class Product extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'admin_product_product';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /* Relations */

    public $attachOne = [
        'image' => 'System\Models\File'
    ];

    public $attachMany = [
        'gallery' => 'System\Models\File'
    ];
}


