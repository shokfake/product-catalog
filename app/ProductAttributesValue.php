<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\ProductAttributesValue
 *
 * @property int product_id
 * @property string value
 * @property int category_attribute_id
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read CategoryAttributes $attribute
 * @property-read Product $product
 * @method static Builder|ProductAttributesValue newModelQuery()
 * @method static Builder|ProductAttributesValue newQuery()
 * @method static Builder|ProductAttributesValue query()
 * @method static Builder|ProductAttributesValue whereCategoryAttributeId($value)
 * @method static Builder|ProductAttributesValue whereCreatedAt($value)
 * @method static Builder|ProductAttributesValue whereId($value)
 * @method static Builder|ProductAttributesValue whereProductId($value)
 * @method static Builder|ProductAttributesValue whereUpdatedAt($value)
 * @method static Builder|ProductAttributesValue whereValue($value)
 * @mixin Eloquent
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
