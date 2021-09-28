<?php


namespace App\Repositories;


use App\helpers\SaveImage;
use App\Model\Page;
use Carbon\Carbon;

class PageRepository implements PageRepositoryInterface
{
    private $classPath = 'App\Model\Page';
    private $imagePath = 'pages';

    public function published()
    {
        return Page::published()->localPage()->get();
    }

    public function all()
    {
        return Page::all();
    }

    public function allWithMeta()
    {
        return Page::with('meta')->get();
    }

    public function requestDataStore($request)
    {
        $data = $this->commonData($request);
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = SaveImage::save($request->featured_image, $this->imagePath);
        }
        return $data;
    }

    public function requestDataUpdate($request, $page)
    {
        $data = $this->commonData($request);

        if ($request->hasFile('featured_image')) {
            if($page->featured_image != null && file_exists('storage/Uploads/Pages/'.$page->featured_image)){
                unlink(base_path().'/public/storage/Uploads/Pages/'.$page->featured_image);
            }
            $data['featured_image'] = SaveImage::update($request->featured_image, $this->imagePath, $page->featured_image ? $page->prevImagePath : '');
        }
        return $data;
    }

    private function commonData($request)
    {
        $data['post_title'] = $request->title;
        $data['url'] = $request->url ?? '#';
        $data['slug'] = $request->slug;
        $data['post_category_id'] = $request->postCategory == 0 ? null : $request->postCategory;
        $data['post_type_id'] = $request->post_type_id;
        $data['summary'] = $request->summary;
        $data['top_content'] = $request->top_content;
        $data['bottom_content'] = $request->bottom_content;
        $data['published'] = switch_case_check($request->published);
        $data['created_by'] = auth('admin')->user()->id;
        $data['created_at'] = $request->created_at ? Carbon::make($request->created_at) : Carbon::now();
        return $data;
    }
}
