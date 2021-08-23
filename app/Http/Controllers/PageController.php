<?php

namespace App\Http\Controllers;

use App\helpers\SaveImage;
use App\Http\Requests\CreatePageRequest;
use App\Model\Page;
use App\Repositories\PageRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Element;
use Yajra\DataTables\DataTables;

class PageController extends Controller
{
    private $classPath = 'App\Model\Page';
    private $imagePath = 'pages';

    public function __construct(PageRepositoryInterface $post)
    {
        $this->post = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.pages.index', $request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('backend.pages.create')->withPostCategory($request->postCategory);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatePageRequest $request)
    {
        if ($request->postCategory > 0) {
            $request->merge(['post_type_id' => 3]);
        } else {
            $request->merge(['post_type_id' => 1]);
        }
        $post = Page::create($this->post->requestDataStore($request));
        storeMeta($post, $request);
        toast(__('global.data_saved'), 'success');
        if ($request->postCategory > 0) {
            return redirect()->route('admin.post-category.show', $request->postCategory);
        } else {
            return redirect()->route('admin.pages.index');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param Page $page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Page $page)
    {
        return view('frontend.pages.inner-page', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Page $page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Page $page)
    {
        $meta = $page->meta;
        return view('backend.pages.edit', compact('page', 'meta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreatePageRequest $request
     * @param Page $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CreatePageRequest $request, Page $page)
    {
        $request->merge([
            'post_type_id' => $page->post_type_id,
            'postCategory' => $page->post_category_id
        ]);
        $updateData = $this->post->requestDataUpdate($request, $page);
        $page->update($updateData);
        updateMeta($page, $request);
        toast(__('global.data_update'), 'success');
        if ($page->post_type_id == 3) {
            return redirect()->route('admin.post-category.show', $page->post_category_id);
        } else {
            return redirect()->route('admin.pages.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param $id
     * @return int
     */
    public function destroy($id)
    {
        $page = Page::withTrashed()->find($id);
        if ($page->deleted_at) {
            $page->restore();
            return 204;
        } else {
            $page->update([
                'published' => 0
            ]);
            return deleteCheckForeignKey($page);
        }
    }

    public function apiDataTable(Request $request)
    {
        if ($request->postCategory) {
            $data = Page::select('id', 'slug', 'post_title', 'published', 'created_at')
                ->where('post_category_id', $request->postCategory)->get();

        } else {
            if ($request->withTrash == 1) {
                $data = Page::select('id', 'slug', 'post_title', 'published', 'created_at')->onlyTrashed()->localPage()->get();
            } else {
                $data = Page::select('id', 'slug', 'post_title', 'published', 'created_at')->localPage()->get();
            }
        }
        return DataTables::of($data)
            ->addColumn('front_view', function ($data) {
                return '<a href="' . route('page.show', $data->slug) . '" target="_blank" class="btn btn-sm btn-success mr-1 " ><i class ="fa fa-eye"></i></a>';
            })
            ->addColumn('action', function ($data) use ($request) {
                if ($request->withTrash == 1) {
                    return recoverAction($data->id, 'admin.pages');
                } else {
                    if ($data->slug == 'home-page') {
                        return showAction($data->id, 'admin.pages') . editAction($data->id, 'admin.pages');
                    } else {
                        return showEditDeleteAction($data->id, 'admin.pages');

                    }
                }
            })
            ->editColumn('published', function ($data) {
                return active_column_check($data->published);
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at . ' ( ' . $data->created_at->diffForHumans() . ' )';
            })
            ->rawColumns(['front_view', 'action', 'published'])
            ->make(true);
    }
}
