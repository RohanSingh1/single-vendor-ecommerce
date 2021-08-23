<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'category';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $guarded = [];
    protected $casts = [
        'published' => 'boolean',
        'is_featured' => 'boolean',
        'is_bestseller' => 'boolean',
    ];

    public function getImagePathAttribute()
    {
        return 'storage/uploads/category/'.$this->image;
    }

    public function ScopePublished($query)
    {
        return $query->where('published', true);
    }

    public function ScopeActive($query)
    {
        return $query->where('published', true);
    }

    public function ScopeFeatured($query)
    {
        $query->where('is_featured', 1);
    }

    public function ScopeNotFeatured($query)
    {
        $query->where('is_featured', 0);
    }

    public function ScopeBestseller($query)
    {
        $query->where('is_bestseller', 1);
    }

    public function ScopeNotBestseller($query)
    {
        $query->where('is_bestseller', 0);
    }

    public function ScopeParentOnly($query)
    {
        return $query->where('parent_id', 0);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'category_color', 'category_id', 'color_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function limitRelationship(string $name, int $limit)
    {
        $this->relations[$name] = $this->relations[$name]->slice(0, $limit);
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function childrenCategories()
    {
        return $this->hasMany(self::class, 'parent_id')->with('children');
    }

    public function activeParent()
    {
        return $this->belongsTo(self::class, 'parent_id')->active();
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function activeChildren()
    {
        return $this->hasMany(self::class, 'parent_id')->active()->select('id', 'name', 'slug', 'parent_id', 'image');
    }

    public function activeChildrenCategories()
    {
        return $this->hasMany(self::class, 'parent_id')->with('activeChildren')->active();
    }

    public function getParentsAttribute()
    {
        $parents = collect([]);
        $parent = $this->parent;
        while (!is_null($parent)) {
            $parents->push($parent);
            $parent = $parent->parent;
        }
        return $parents;
    }
}
