<?php

namespace App\Http\Controllers;

use App\Model\Product;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Yajra\DataTables\Facades\DataTables;

class ProductImageController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $this->validate($request, ['image' => 'required']);
        if ($request->hasFile('image')) {
            foreach ($request->image as $image) {
                if ($request->uploadType == 'image') {
                    $mediaItem = $product->addMedia($image)
                        ->withResponsiveImages()
                        ->toMediaCollection('products');
                    if ($request->color != '0') {
                        $mediaItem->setCustomProperty('color', $request->color);
                        $mediaItem->save();
                    }
                } else {
                    $mediaItem = $product->addMedia($image)
                        ->toMediaCollection('products-file');
                }
            }
        }
        toast(__('global.data_saved'), 'success');
        return redirect()->back();
    }

    public function show(Media $mediaItem)
    {
        return response()->download($mediaItem->getPath(), $mediaItem->file_name);
    }

    public function downloadAll(Product $product)
    {
        // Let's get some media.
        $downloads = $product->getMedia('downloads');

        return Media::create($product->name . '.zip')->addMedia($downloads);
    }

    public function update(Product $product, $pImage)
    {
        $product->update([
            'featured_image' => $pImage
        ]);
        toast(__('global.data_update'));
        return redirect()->back();
    }

    public function makeThumbnail(Product $product, $pImage)
    {
        $product->update([
            'thumbnail_image' => $pImage
        ]);
        toast(__('global.data_update'));
        return redirect()->back();
    }

    public function destroy($pImage)
    {
        $pImage = Media::find($pImage);
        if ($pImage) {
            $pImage->delete();
            return 204;
        } else {
            return 23000;
        }
    }

    public function destroyALl($pImage)
    {
        Product::findorfail($pImage)->clearMediaCollection('products');
        return 204;
    }

    public function saveOrder(Request $request)
    {
        $dataCount = 1;
        dd($request->data);
        foreach ($request->data as $data) {
            $media = Media::find($data['id']);
            $media->order_column = $dataCount;
            $media->save();
            $dataCount++;
        }
        toast(__('global.data_saved'), 'success');
        return 200;
    }

    public function productImage(Request $request)
    {
        $data = Product::find($request->product_id)->getMedia('products');
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return deleteAction($data->id, 'admin.products.image-upload');
            })
            ->addColumn('primary', function ($data) {
                return makePrimary('admin.products.image-upload.make-primary',
                    ['product' => $data->model_id, 'pImage' => $data->id]);
            })
            ->addColumn('image', function ($data) {
                return '<img src="' . $data->getUrl('thumb') . '" width="50px" height="50px">';
            })
            ->rawColumns(['action', 'image', 'primary'])
            ->make(true);
    }
}
