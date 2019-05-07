<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 */
class Category extends Model
{
    protected $fillable = ['name'];

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function users() {
        return $this->belongsTo(User::class,'user_id');
    }
}
