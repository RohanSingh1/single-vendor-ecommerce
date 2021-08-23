<?php

namespace App\Http\Controllers;

use App\Model\Menu;
use App\Model\MenuItem;
use App\Model\Page;
use App\Repositories\PageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MenuItemController extends Controller
{

    public function store(Request $request)
    {
        $page = new PageRepository();
        $request->merge(
            [
                'post_type_id' => 2,
                'published' => 1
            ]
        );
        $post = Page::create($page->requestDataStore($request));
        $menu = Menu::find($request->menu_id);
        MenuItem::create(
            [
                'post_id' => $post->id,
                'menu_id' => $request->menu_id,
                'menu_icon' => $request->menu_icon,
                'url_target' => $request->url_target ?? '#',
                'parent_id' => 0
            ]
        );
        $this->forgetCache($menu->slug);
        toast(__('global.data_saved'), 'success');
        return redirect()->back();

    }

    public function update(Menu $menu, Request $request)
    {
        foreach ($request->add_page as $page) {
            MenuItem::create(
                [
                    'post_id' => $page,
                    'menu_id' => $menu->id
                ]
            );
        }
        $this->forgetCache($menu->slug);
        toast(__('global.data_saved'), 'success');
        return redirect()->back();
    }

    public function saveOrder(Request $request)
    {
        $input = $request->data;
        $dataCount = 1;
        $childCount = 1;
        $subfieldCount = 1;
        foreach ($input as $data) {
            foreach ($data['children'] ?? [] as $child) {
                foreach ($child['children'] ?? [] as $subchild) {
                    $menus = MenuItem::find($subchild['id']);
                    $menus->parent_id = $child['id'];
                    $menus->order = $subfieldCount;
                    $menus->save();
                    $subfieldCount++;
                }
                $menuChildren = MenuItem::find($child['id']);
                $menuChildren->parent_id = $data['id'];
                $menuChildren->order = $childCount;
                $menuChildren->save();
                $childCount++;
            }
            $menu = MenuItem::find($data['id']);
            $menu->parent_id = 0;
            $menu->order = $dataCount;
            $menu->save();
            $dataCount++;
        }
        toast(__('global.data_saved'), 'success');
        $menus = Menu::select('slug')->get();
        foreach ($menus as $menu) {
            $this->forgetCache($menu->slug);
        }
        return 'true';
    }

    private function forgetCache($menuItem)
    {
        Cache::forget('menu-item-' . $menuItem);
    }

    public function destroy(MenuItem $menuItem)
    {
        return deleteCheckForeignKey($menuItem);
    }
}
