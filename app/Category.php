<?php

namespace App;

use App\Http\Requests\CategoryRequest;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Category
 *
 * @property integer id
 * @property string $name
 * @property int|null $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|CategoryAttributes[] $attributes
 * @property-read Collection|Product[] $products
 * @property-read User|null $user
 * @method static Category getCategoriesByUser($user)
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @method static Builder|Category whereCreatedAt($value)
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereName($value)
 * @method static Builder|Category whereUpdatedAt($value)
 * @method static Builder|Category whereUserId($value)
 * @mixin Eloquent
 */
class Category extends Model
{
    protected $fillable = ['name', 'user_id'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function attributes()
    {
        return $this->hasMany(CategoryAttributes::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @param Builder $builder
     * @param User $user
     * @return Category|Category[]|Builder|Collection
     */
    public function scopeGetCategoriesByUser(Builder $builder, User $user)
    {

        return $user->hasRole('Super Admin') ? self::all() : $builder->whereUserId($user->id)->get();
    }

    public function setCategoryAttributes(CategoryRequest $request)
    {
        if (!$request->has('attributes')) {
            return;
        }

        foreach ($request->get('attributes') as $attribute) {
            CategoryAttributes::updateOrCreate(
                [
                    'id' => $attribute['id'],
                    'category_id' => $this->id,
                ],
                [

                    'category_id' => $this->id,
                    'name' =>  $attribute['name'],
                ]);
           }
    }

}
