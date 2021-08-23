<?php

namespace App\Http\Livewire\Frontend\Pages;

use App\Facades\SortBy;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Color;
use Livewire\Component;
use Livewire\WithPagination;

class ResultProducts extends Component
{
    use WithPagination;

    public $category, $colors;
    public $loadProducts = false;
    public $q, $categories, $brands, $sort_by, $order_by, $brand, $maxPrice, $minPrice, $selectedBrands = [],
        $categoryId, $color, $productsCount;

    protected $updatesQueryString = ['q', 'categoryId', 'color', 'minPrice', 'maxPrice', 'selectedBrands'];

    public function loadProducts()
    {
        $this->loadProducts = true;
    }

    public function mount($q, $selectedBrands, $minPrice, $maxPrice, $categoryId, $color)
    {
        $this->q = $q;
        $this->minPrice = $minPrice;
        $this->maxPrice = $maxPrice;
        $this->color = $color;
        $this->category = Category::with('colors')->find($categoryId);
        $this->brands = Brand::select('id', 'brand_name')->get();
        $this->colors = $this->category ? $this->category->colors : Color::get();
        $this->sort_by = 'created_at';
        $this->order_by = 'desc';
        if (!empty($this->category)) {
            $this->categoryId = $this->category->id;
        } else {
            $this->categoryId = '';
        }

        $selectedBrands == '' ? $this->selectedBrands = [] : $this->selectedBrands = $selectedBrands;
//        $this->productsCount = $this->productsCount();
    }

    public function selectColor($value)
    {
        $this->color = $value;
    }

    public function selectBrand($val)
    {
        $selBrands = $this->selectedBrands;
        $search = array_search($val, $selBrands);
        if ($search === false) {
            array_push($selBrands, $val);
        } else {
            unset($selBrands[$search]);
        }
        $this->selectedBrands = '';
        $this->selectedBrands = $selBrands;
    }

    public function productsCount()
    {

        return SortBy::searchProductCount($this->makeSearchQuery());
    }

    public function sortByFilter()
    {
        return $this->loadProducts ? SortBy::sortByFilter($this->q, $this->categoryId, $this->sort_by, $this->minPrice, $this->maxPrice, $this->selectedBrands, $this->color) : ['searching'];
    }

    protected function makeSearchQuery()
    {
        return [
            'q' => $this->q,
            'categoryId' => $this->categoryId,
            'minPrice' => $this->minPrice,
            'maxPrice' => $this->maxPrice,
            'selectedBrands' => $this->selectedBrands,
            'colorId' => $this->color
        ];
    }

    public function render()
    {
        return view('livewire.frontend.pages.result-products',
            [
                'products' => $this->sortByFilter()
            ]);
    }
}
