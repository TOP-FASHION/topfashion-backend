<?php

use Admin\Product\Models\Product;

Route::get('product', function(){
  $product = Product::with(['image','gallery'])->get();
  return $product;
});