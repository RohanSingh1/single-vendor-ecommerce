<?php

namespace App\Http\Controllers;

use App\Model\Color;
use Carbon\Carbon;
use App\Model\Product;
use App\Model\Category;
use App\Model\SubCategory;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{

    public $template;
    public $priceTemplate;
    public $nameTemplate;
    public $priceFont;
    public $titleFont;

    public function __construct()
    {
        $this->middleware(['auth:admin','AdminRoleValidation']);
        // $this->middleware('permission:product-price-show', ['only' => ['showPrice']]);
    }

    public function index()
    {
        return view('backend.products.index');
    }

    public function create()
    {
        $data['categories'] = Category::select('id', 'name', 'parent_id')->orderBy('order')->active()->with('parent')->get();
        $data['colors'] = Color::get();
        return view('backend.products.create', $data);
    }

    public function store(CreateProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = generateUniqueSlug('App\Model\Product', $request->name);
        $data['published'] = switch_case_check($request->published);
        $data['is_featured'] = switch_case_check($request->is_featured);
        if ($request->custom == 'on' & $request->file('feature_image') != '') {
            $data['feature_image'] = Product::saveProductImage($request->file('feature_image'), $request->product_name, $request->selling_price);
        } elseif ($request->file('feature_image') != '') {
            $data['feature_image'] = Product::saveProductImageWithoutEdit($request->file('feature_image'));
        }
        $product = Product::create($data);
        $cat_array = buildCategory($request->category_id);
        $product->categories()->attach($cat_array);
        $product->colors()->attach($request->colors);
        storeMeta($product, $request);
        toast(__('global.data_saved'), 'success');
        return redirect()->route('admin.products.edit', $product->id);
    }


    public function show(Product $product)
    {
        return view('backend.products.show', compact('product'));
    }

    public function showPrice($product)
    {
        $product = Product::findOrFail($product);
        return view('backend.products.price', compact('product'));
    }

    public function edit(Product $product)
    {
        $data['product'] = $product;
        $data['colors'] = Color::get();
        $data['categories'] = Category::select('id', 'name', 'parent_id')->orderBy('order')->active()->with('parent')->get();
        return view('backend.products.edit', $data);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->all();
        $data['is_featured'] = switch_case_check($request->is_featured);
        $data['published'] = switch_case_check($request->published);
        if ($request->custom == 'on' & $request->file('feature_image') != '') {
            $data['feature_image'] = Product::saveProductImage($request->file('feature_image'), $request->product_name, $request->selling_price);
        } elseif ($request->file('feature_image') != '') {
            $data['feature_image'] = Product::saveProductImageWithoutEdit($request->file('feature_image'));
        }
        $product->update($data);
        $cat_array = buildCategory($request->category_id);
        $product->categories()->sync($cat_array);
        $product->colors()->sync($request->colors);
        updateMeta($product, $request);
        toast(__('global.data_update'), 'success');
        return redirect()->route('admin.products.index');
    }

    public function destroy(Product $product)
    {
//        if(count($product->contactProduct)>0){
//            return 23000;
//        }
        $product->delete();
        toast(__('global.data_deleted'), 'success');
        return 204;
    }

    public function apiProduct()
    {
        $products = Product::select('id', 'slug', 'name', 'model_no', 'quantity', 'price', 'featured_image', 'supplier_id', 'brand_id', 'is_featured')
            ->with('brand', 'supplier', 'featuredImage')
            ->orderBy('updated_at')
            ->get();
        return Datatables::of($products)
            ->addColumn('front_view', function ($data) {
                return '<a href="' . route('product.show', $data->slug) . '" target="_blank" class="btn btn-sm btn-success mr-1 " ><i class ="fa fa-eye"></i></a>';
            })
            ->addColumn('action', function ($product) {
                return showEditDeleteAction($product->id, 'admin.products');
            })
            ->addColumn('brand_name', function ($product) {
                return '' . $product->brand->brand_name . '';
            })
            ->addColumn('suppliers', function ($product) {
                return '' . $product->supplier->supplier_name . '';
            })
            ->addColumn('image', function ($data) {
                if ($data->featuredImage) {
                    return '<img src="' . asset($data->featuredImage->getUrl()) . '" width="50px" >';
                } else {
                    return '<img src="' . asset('no-image.jpg') . '"  width="50px">';
                }
            })
            ->editColumn('is_featured', function ($data) {
                return active_column_check($data->is_featured);
            })
            ->rawColumns(['image', 'action', 'front_view', 'is_featured'])
            ->make(true);
    }
}
