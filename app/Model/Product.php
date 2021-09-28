<?php

namespace App\Model;

use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $table = 'products';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'name', 'purchased_price', 'slug','price', 'old_price', 'quantity', 'model_no', 'published', 'short_desc',
        'description', 'brand_id', 'supplier_id', 'featured_image', 'is_featured', 'type', 'thumbnail_image',
        'is_bestseller','is_fresh','tags', 'order'
    ];
    protected $casts = [
        'is_featured' => 'boolean',
        'is_bestseller' => 'boolean',
        'published' => 'boolean',
    ];


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('products')
            ->registerMediaConversions(function (Media $media) {
//                $this->addMediaConversion('featured')
//                    ->withResponsiveImages()
//                    ->width(600)
//                    ->height(600);
//                $this->addMediaConversion('thumb')
//                    ->withResponsiveImages()
//                    ->width(200)
//                    ->height(200);
            });
        $this->addMediaCollection('products-file');
    }

    public function contactProduct()
    {
        return $this->hasMany(ContactProduct::class, 'product_id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }

    public function ScopePublished($query)
    {
        $query->where('published', 1);

    }

    public function ScopeFeatured($query)
    {
        $query->where('is_featured', 1);
    }

    public function ScopeBestseller($query)
    {
        $query->where('is_bestseller', 1);
    }

    public function ScopeIsfresh($query)
    {
        $query->where('is_fresh', 1);
    }

    public function ScopeNotBestseller($query)
    {
        $query->where('is_bestseller', 0);
    }

    public function thumbnailImage()
    {
        return $this->belongsTo(Media::class, 'thumbnail_image');
    }

    public function featuredImage()
    {
        return $this->belongsTo(Media::class, 'featured_image');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->where('published', true);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function meta()
    {
        return $this->morphOne(Meta::class, 'metaable')->orderBy('id','desc');
    }
 
    public static function saveProductImageWithoutEdit($image)
    {
        $filename = time().'-'.$image->getClientOriginalName();
        $fileSavePath = storage_path('app/public/images/products/'.$filename);
        $img = Image::make($image)->resize(1920, 1920);
        $img->save($fileSavePath);
        $dbNamePath = 'storage/images/products/'.$filename;
        return $dbNamePath;
    }

    public static function saveProductImage($image, $name, $price)
    {

        $img = makeImageForPublish($image, $name, $price);

        $filename = time().'-'.$image->getClientOriginalName();
        $fileSavePath = storage_path('app/public/images/products/'.$filename);
        $img->save($fileSavePath);
        $dbNamePath = 'storage/images/products/'.$filename;
        return $dbNamePath;
    }

    public function reviews()
    {
        return $this->hasMany(Reviews::class);
    }

    public function coupons(){
        return $this->belongsToMany(Coupon::class, 'coupon_product', 'product_id', 'coupon_id');
    }

    public function orders(){
        return $this->belongsToMany(Order::class, 'order_product', 'product_id', 'order_id');
    }

}
