<?php


namespace App\Repositories;

use App\Model\Menu;
use App\Model\MenuItem;
use App\Model\Page;

class MenuRepository implements MenuRepositoryInterface
{
    public function selectedMenu()
    {
        return Menu::selected()->first();
    }

    public function getMenus()
    {
        return Menu::get();
    }
    public function find($menu)
    {
        return Menu::find($menu);
    }

    public function getPages()
    {
        return Page::select('id','post_title')
            ->localPage()
            ->published()
            ->orderBy('post_title','asc')
            ->get();
    }
    public function parent()
    {
        $selected = $this->selectedMenu();
        return MenuItem::where('menu_id',$selected->id)
            ->parentOnly()
            ->with('childrenCategories','post','childrenCategories.children','childrenCategories.children.post','childrenCategories.post')
            ->withCount('childrenCategories')
            ->orderBy('order')
            ->get();
    }

}
