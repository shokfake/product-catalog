<?php

namespace App;

use App\Http\Requests\CategoryRequest;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    /**
     * @return mixed
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * @return HasMany
     */
    public function attributes(): HasMany
    {
        return $this->hasMany(CategoryAttributes::class);
    }

    public function user(): BelongsTo
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

        if ($user->hasRole('Super Admin')) {
            return self::all();
        }

        return $builder->whereUserId($user->id)->get();
    }

    /**
     * @param CategoryRequest $request
     */
    public function setCategoryAttributes(CategoryRequest $request): void
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
                    'name' => $attribute['name'],
                ]);
        }
    }

}
