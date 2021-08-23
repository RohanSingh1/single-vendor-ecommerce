<?php

namespace App\Http\Controllers;

use App\Model\Menu;
use App\Repositories\MenuRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MenuController extends Controller
{
    public function __construct(MenuRepositoryInterface $menu)
    {
        $this->menu = $menu;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $data['menuItems'] = $this->menu->parent();
//        dd($data['menuItems']);
        $data['selectedMenu'] = $this->menu->selectedMenu();
        $data['menus'] = $this->menu->getMenus();
        $data['pages'] = $this->menu->getPages();

        return view('backend.content-management.menus.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    public function toggleActive(Menu $menu)
    {
        $menu->is_active = !$menu->is_active;
        $menu->save();
        toast(__('global.data_update'), 'success');
        return redirect()->back();
    }

    public function changeSelected(Request $request)
    {
        $selectedMenu = $this->menu->selectedMenu();
        $selectedMenu->update(['is_selected' => false]);
        $changeMenu = $this->menu->find($request->menu_id);
//        $changeMenu->is_selected=true;
//        $changeMenu->save();
        $changeMenu->update([
            'is_selected' => true
        ]);
        toast(__('global.data_update'), 'success');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Menu $menu
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Menu $menu)
    {
        $this->validate($request, ['title' => 'required|string|max:255']);
        $menu->update(['title' => $request->title]);
        toast(__('global.data_update'), 'success');
        Cache::forget('menu-item-' . $menu->slug);
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
