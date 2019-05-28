<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\CategoryAttributes
 *
 * @property mixed name
 * @property int category_id
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Category $category
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoryAttributes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoryAttributes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoryAttributes query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoryAttributes whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoryAttributes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoryAttributes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoryAttributes whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CategoryAttributes whereUpdatedAt($value)
 * @method static Builder|Category getAttributesByProduct(Product $product)
 * @method static getAttributesProduct(Product $product)
 * @mixin \Eloquent
 */
class CategoryAttributes extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function values()
    {
        return $this->hasMany(ProductAttributesValue::class, 'category_attribute_id');
    }
    /**
     * @param Builder $builder
     * @param Product $product
     * @return Builder
     */
    public function scopeGetAttributesByProduct(Builder $builder, Product $product)
    {
        return $builder
            ->join('product_attributes_values', 'category_attributes.id', '=', 'product_attributes_values.category_attribute_id')
            ->select(['category_attributes.id', 'category_attributes.name', 'product_attributes_values.value'])->where('product_attributes_values.product_id', '=', $product->id)
            ->whereCategoryId($product->category_id)->get();
    }
}
