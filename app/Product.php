<?php


namespace App;


use App\Http\Requests\ProductRequest;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;


/**
 * App\Product
 *
 * @property Category category
 * @property string name
 * @property string image
 * @property int category_id
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|ProductAttributesValue[] $attributes
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product whereCategoryId($value)
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereImage($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @method static getProductsAddedToday()
 * @mixin Eloquent
 */
class Product extends Model
{
    public const GATE_ACTION_WITH_PRODUCT = 'action-with-product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image', 'category_id'
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function attributes(): HasMany
    {
        return $this->hasMany(ProductAttributesValue::class);
    }

    public static function getNameUploadImage(ProductRequest $request): string
    {
        $imageName = '';

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(200, 200)->save(public_path('uploads/') . $filename);
            $imageName = $filename;
        };

        return $imageName;
    }

    public function setProductAttributes(ProductRequest $request): void
    {
        if (!$request->has('attributes')) {
            return;
        }

        foreach ($request->get('attributes') as $attribute) {
            ProductAttributesValue::updateOrCreate(
                [
                    'product_id' => $this->id,
                    'category_attribute_id' => $attribute['id'],
                ],
                [
                    'product_id' => $this->id,
                    'category_attribute_id' => $attribute['id'],
                    'value' => $attribute['value'],
                ]
            );
        }
    }

    public static function scopeGetProductsAddedToday(Builder $builder)
    {
        return $builder->where('created_at', '>=', Carbon::today()->toDateString())->get();
    }

    /**
     * @return Product|Builder|Model|object|null
     */
    public function getProductsWithCategory()
    {
        return self::with('category')->with('attributes')->whereId($this->id)->first();
    }

}
