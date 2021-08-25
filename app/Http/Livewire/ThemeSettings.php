<?php

namespace App\Http\Livewire;

use App\Model\Setting;
use App\Model\SettingsUser;
use Illuminate\Support\Facades\Cache;
use Livewire\Component; 

class ThemeSettings extends Component
{

    public $sidebarColors,$headerColors,$sidebarColor,$headerColor,$sidebarPosition,$headerPosition,$footerPosition;
    public function mount($sidebarPosition,$headerPosition,$footerPosition,$headerColor,$sidebarColor)
    {
        if (count(auth('admin')->user()->userSettings) == 0) {
            $this->setSetting(1,'sidebar-position');
            $this->setSetting(2,'footer-position');
            $this->setSetting(3,'header-position');
            $this->setSetting(10,'header-color');
            $this->setSetting(46,'sidebar-color');
        }
        $this->sidebarColors=allColors('sidebar-color');
        $this->headerColors=allColors('header-color');
        $this->headerColor=$headerColor;
        $this->sidebarColor=$sidebarColor;
        $this->sidebarPosition=$sidebarPosition;
        $this->headerPosition=$headerPosition;
        $this->footerPosition=$footerPosition;
    }

    private function setSetting($settingsId,$slug)
    {
        SettingsUser::create(
            [
                'settings_id'=>$settingsId,
                'user_id'=>auth('admin')->user()->id,
                'slug'=>$slug,
            ]
        );
    }

    public function changeColor($id, $slug)
    {
        Cache::forget(colorCacheName($slug));
        $prevSetting =SettingsUser::where('slug',$slug)
            ->where('user_id',auth('admin')->user()->id)
            ->first();
        $prevSetting->update([
            'settings_id'=>$id,
        ]);
    }

    public function changePosition($slug)
    {
        Cache::forget(positionCacheName($slug));
        $prevSetting =SettingsUser::where('slug',$slug)
            ->where('user_id',auth('admin')->user()->id)
            ->first();
        $prevSetting->update([
            'active'=>!$prevSetting->active
        ]);
    }


    public function render()
    {
        return view('livewire.theme-settings');
    }
}
