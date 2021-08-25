<?php

namespace App\Http\Livewire;

use App\Http\Requests\CreateProductRequest;
use App\Model\Brand;
use App\Model\Product; 
use Livewire\Component;
use App\Model\Category;
use App\Model\Supplier;
use App\Model\SubCategory;

class CreateProduct extends Component
{
    public $product_name;
    public $purchased_price;
    public $selling_price;
    public $quantity;
    public $model_no;
    public $supplier_id;
    public $brand_id;
    public $category_id;
    public $sub_category_id;
    public $description;
    public $readyToLoad = false;

    public function loadPosts()
    {
        $this->readyToLoad = true;
    }
    public function storeProduct()
    {
        $this->validate([
            'product_name' => 'required',
            'purchased_price' => 'required|integer|min:0',
            'selling_price' => 'required|integer|min:0',
            'quantity' => 'required|string|max:255',
            'model_no' => 'required',
            'brand_id' => 'required|numeric',
            'supplier_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'sub_category_id' => 'required|numeric',
            'description' => 'nullable',
        ]);
        Product::Create([
            'product_name' => $this->product_name,
            'purchased_price' => $this->purchased_price,
            'selling_price' => $this->selling_price,
            'quantity' => $this->quantity,
            'model_no' => $this->model_no,
            'supplier_id' => $this->supplier_id,
            'brand_id' => $this->brand_id,
            'category_id' => $this->category_id,
            'sub_category_id' => $this->sub_category_id,
            'description' => $this->description,
        ]);
        $this->product_name = '';
        $this->purchased_price = '';
        $this->selling_price = '';
        $this->quantity = '';
        $this->model_no = '';
        $this->supplier_id = '';
        $this->brand_id = '';
        $this->category_id = '';
        $this->sub_category_id = '';
        $this->description = '';
    }
    public function render()
    {
        $data['brand'] = Brand::all();
        $data['category'] = Category::all();
        $data['subCategory'] = SubCategory::all();
        $data['suppliers'] = Supplier::all();
        return view('livewire.create-product', $data);
    }
}
