<?php


namespace App;


use Illuminate\Database\Eloquent\Model;


/**
 * @property Category category
 * @property string name
 * @property string image
 * @property int category_id
 */
class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image', 'category_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}