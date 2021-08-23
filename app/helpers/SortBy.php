<?php


namespace App\helpers;


use App\Model\Brand;
use App\Model\Product;

class SortBy
{
    public $sortBy, $sortByOrder;

    public function searchBrand($brand)
    {
        return Brand::select('id', 'name')
            ->where('name', 'like', '%' . $brand . '%')
            ->active()->orderBy('name')
            ->withCount('activeProducts')
            ->get();
    }

    public function searchProduct($q, $categoryId = '', $sort = '', $order = '', $min_price = '', $max_price = '', $selectedBrands = '', $colorId = '')
    {
        empty($sort) ? $sortBy = 'updated_at' : $sortBy = $sort;
        empty($order) ? $orderBy = 'desc' : $orderBy = $order;
        if ($q == '' && $categoryId == '') {
            return [];
        } else {
            return Product::
            where(function ($query) use ($q) {
                if (isset($q)) {
                    $query->where('name', 'like', '%' . $q . '%')
                        ->orWhere('model_no', 'like', '%' . $q . '%')
                        ->orWhere('tags', 'like', '%' . $q . '%');
                }
            })
                ->where(function ($q) use ($categoryId) {
                    if ($categoryId) {
                        $q->whereHas('categories', function ($q) use ($categoryId) {
                            $q->where('id', $categoryId);
                        });
                    }
                })
                ->where(function ($q) use ($colorId) {
                    if ($colorId) {
                        $q->whereHas('colors', function ($q) use ($colorId) {
                            $q->where('id', $colorId);
                        });
                    }
                })
                ->where(function ($query) use ($q, $selectedBrands, $min_price, $max_price) {
                    if (isset($min_price) && $max_price) {
                        $query->where('price', '>=', $min_price)
                            ->where('price', '<=', $max_price);
                        if (isset($selectedBrands)) {
                            foreach ($selectedBrands as $brand) {
                                $query->where('price', '>=', $min_price)
                                    ->where('price', '<=', $max_price)
                                    ->where(function ($query) use ($brand) {
                                        return $query->orWhere('brand_id', $brand);
                                    });
                            }
                        }
                        return $query->where('price', '>=', $min_price)
                            ->where('price', '<=', $max_price);
                    }
                    if (isset($selectedBrands)) {
                        foreach ($selectedBrands as $brand) {
                                $query->orWhere('brand_id', $brand);
                        }
                    }
                })
                ->with([
                    'media',
                    'brand',
                    'thumbnailImage',
                ])
                ->published()
                ->orderBy('products.order')
                ->orderBy('products.updated_at')
                ->paginate(8);
        }
    }

    public function searchProductCount($query)
    {
        $q = $query['q'];
        $categoryId = $query['categoryId'];
        $min_price = $query['minPrice'];
        $max_price = $query['maxPrice'];
        $selectedBrands = $query['selectedBrands'];
        $colorId = $query['colorId'];
        if ($q == '' && $categoryId == '') {
            return [];
        } else {
            return Product::
            where(function ($query) use ($q) {
                if (isset($q)) {
                    return $query->where('name', 'like', '%' . $q . '%')
                        ->orWhere('model_no', $q)
                        ->orWhere('tags', $q);
                }
            })
                ->where(function ($q) use ($categoryId) {
                    if ($categoryId)
                        $q->whereHas('categories', function ($q) use ($categoryId) {
                            return $q->where('id', $categoryId);
                        });
                })
                ->where(function ($q) use ($colorId) {
                    if ($colorId) {
                        $q->whereHas('colors', function ($q) use ($colorId) {
                            return $q->where('id', $colorId);
                        });
                    }
                })->where(function ($query) use ($min_price, $max_price) {
                    if (!is_null($min_price) && !is_null($max_price)) {
                        $query->whereBetween('products.price', [$min_price, $max_price]);
                    } elseif (!is_null($min_price)) {
                        $query->where('products.price', '>=', $min_price);
                    } elseif (!is_null($max_price)) {
                        $query->where('products.price', '<=', $max_price);
                    }
                })
                ->where(function ($query) use ($q, $selectedBrands) {
                    if (isset($selectedBrands)) {
                        foreach ($selectedBrands as $brand) {
                            return $query->where(function ($query) use ($brand) {
                                return $query->orWhere('manufacturer_id', $brand);
                            });
                        }
                    }
                })
                ->published()
                ->select(
                    \DB::raw("MIN(price) AS minPrice, MAX(price) AS maxPrice, COUNT(name) AS productCount")
                )
                ->first();
        }
    }

    public function sortByFilter($query, $categoryId, $sort_by, $minPrice, $maxPrice, $selectedBrands, $colorId)
    {
        switch ($sort_by) {
            case 'latest':
                $products = $this->searchProduct($query, $categoryId, 'created_at', 'desc', $minPrice, $maxPrice, $selectedBrands, $colorId);
                break;
            case 'popularity':
                $products = $this->searchProduct($query, $categoryId, 'total_views', 'desc', $minPrice, $maxPrice, $selectedBrands, $colorId);
                break;
            case 'high-to-low':
                $products = $this->searchProduct($query, $categoryId, 'price', 'desc', $minPrice, $maxPrice, $selectedBrands, $colorId);
                break;
            case 'low-to-high':
                $products = $this->searchProduct($query, $categoryId, 'price', 'asc', $minPrice, $maxPrice, $selectedBrands, $colorId);
                break;
            default:
                $products = $this->searchProduct($query, $categoryId, 'price', 'desc', $minPrice, $maxPrice, $selectedBrands, $colorId);
        }
        $this->sortBy = $sort_by;
        return $products;
    }

    public function brandFilter($query, $brandId, $previousBrandId = '')
    {
        if (empty($brandId)) {
            return $this->searchProduct($query);
        }
        return Product::
        where('name', 'like', '%' . $query . '%')
            ->where('brand_id', $brandId)
            ->orderBy('name', 'asc')
            ->with('meta', 'media', 'manufacturer', 'currency', 'categories', 'featuredImage', 'categories.parent')
            ->published()
            ->get();
    }

}
