<?php

namespace App\Http\Livewire\Frontend\Layouts;

use App\Model\Menu;
use App\Model\MenuItem;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Navbar extends Component
{
    public $readyToLoad = false;

    public function loadPosts()
    {
        $this->readyToLoad = true;
    }
    private function mainMenu($menu)
    {
//        return Cache::remember('menu-item-' . $menu,60, function () use ($menu) {
            $menuId = Menu::whereSlug($menu)->active()->first();
            if ($menuId) {
                return MenuItem::where('menu_id', $menuId->id)
                    ->parentOnly()
                    ->with('childrenCategories', 'publishedPost', 'childrenCategories.children', 'childrenCategories.children.publishedPost', 'childrenCategories.publishedPost')
                    ->withCount('childrenCategories')
                    ->orderBy('order')
                    ->get();
            } else {
                return [];
            }
}

    public function render()
    {
        return view('livewire.frontend.layouts.navbar', [
            'categories' => catMenuBuilder(),
            'facebook' => get_general_settings_text('facebook'),
            'twitter' => get_general_settings_text('twitter'),
            'google_plus' => get_general_settings_text('google_plus'),
            'youtube' => get_general_settings_text('youtube'),
            'instagram' => get_general_settings_text('instagram'),
            'linkedin' => get_general_settings_text('linkedin'),
            'preNav' => $this->mainMenu('pre-nav'),
            'mainMenu' => $this->mainMenu('main-menu'),
//            'mainMenu' => $this->readyToLoad ? $this->mainMenu('main-menu') ?? [] : [],
        ]);
    }
}
