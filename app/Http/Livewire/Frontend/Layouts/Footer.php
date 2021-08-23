<?php

namespace App\Http\Livewire\Frontend\Layouts;

use App\Model\Menu;
use App\Model\MenuItem;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Footer extends Component
{
    private function footerMenu($menu)
    {
//        return Cache::remember('menu-item-' . $menu,60, function () use ($menu) {
            $menuId = Menu::whereSlug($menu)->active()->first();
            if ($menuId) {
                return MenuItem::whereMenuId($menuId->id)
                    ->orderBy('order')
                    ->parentOnly()
                    ->with('publishedPost', 'menu')
                    ->get();
            } else {
                return [];
            }
//        });

    }

    public function render()
    {
        return view('livewire.frontend.layouts.footer', [
            'facebook' => get_general_settings_text('facebook'),
            'twitter' => get_general_settings_text('twitter'),
            'google_plus' => get_general_settings_text('google_plus'),
            'youtube' => get_general_settings_text('youtube'),
            'instagram' => get_general_settings_text('instagram'),
            'linkedin' => get_general_settings_text('linkedin'),
            'firstFooterMenus' => $this->footerMenu('first-footer'),
            'secondFooterMenus' => $this->footerMenu('second-footer'),
        ]);
    }
}
