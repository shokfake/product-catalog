<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int product_id
 * @property string value
 * @property int category_attribute_id
 */
class ProductAttributesValue extends Model
{
    protected $fillable = ['category_attribute_id','product_id','value'];
    public function product() {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function attribute() {
        return $this->belongsTo(CategoryAttributes::class,'category_attribute_id');
    }
}
