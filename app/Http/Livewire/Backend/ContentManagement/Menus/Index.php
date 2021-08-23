<?php

namespace App\Http\Livewire\Backend\ContentManagement\Menus;

use App\Model\MenuItem;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Index extends Component
{
    public $menuItems, $displayName, $menuIcon, $menuDescription, $urlTarget = 0, $url;
    public $editMode = false, $editMenu;

    public function mount($menuItems)
    {
        $this->menuItems = $menuItems;
    }

    public function editMenuItem($menuItem)
    {
        $this->editMode = true;
        $this->editMenu = MenuItem::find($menuItem);
        $this->displayName = $this->editMenu->display_name ?? $this->editMenu->post->post_title;
        $this->menuIcon = $this->editMenu->menu_icon;
        $this->menuDescription = $this->editMenu->menu_description;
        $this->urlTarget = $this->editMenu->url_target;
        $this->url = $this->editMenu->post->url;
    }

    public function updateMenuItem()
    {
        $this->validate([
            'displayName' => 'required|string|max:255',
            'menuIcon' => 'nullable|string|max:255',
            'menuDescription' => 'nullable|string|max:255',
        ]);
        $updateMenu = MenuItem::find($this->editMenu->id);
        $updateMenu->update([
            'display_name' => $this->displayName,
            'menu_icon' => $this->menuIcon,
            'menu_description' => $this->menuDescription,
            'url_target' => $this->urlTarget,
        ]);
        $updateMenu->post->update([
            'url' => $this->url
        ]);
        toast(__('global.data_update'), 'success');
        $this->editMode = false;
        Cache::forget('menu-item-' . $updateMenu->menu_id);
        return redirect()->route('admin.content-management.menus.index');
    }

    public function render()
    {
        return view('livewire.backend.content-management.menus.index');
    }
}
