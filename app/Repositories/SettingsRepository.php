<?php


namespace App\Repositories;


use App\helpers\SaveImage;
use App\Model\Setting;
use Illuminate\Support\Facades\Cache;

class SettingsRepository implements SettingsRepositoryInterface
{
    private $classPath = 'App\Model\Setting';

    public function all()
    {
        $data['site_logo_1'] = get_general_settings_file('site_logo_1');
        $data['site_logo_2'] = get_general_settings_file('site_logo_2');
        $data['favicon'] = get_general_settings_file('favicon');
        $data['site_title'] = get_general_settings_text('site_title');
        $data['tagline'] = get_general_settings_text('tagline');
        $data['address'] = get_general_settings_text('address');
        $data['phone_no'] = get_general_settings_text('phone_no');
        $data['ac_email'] = get_general_settings_text('ac_email');
        $data['shipping_price'] = get_general_settings_text('shipping_price');
        $data['front_info1'] = get_general_settings_text('front_info1');
        $data['front_info2'] = get_general_settings_text('front_info2');
        $data['front_info3'] = get_general_settings_text('front_info3');

        $data['top_a1'] = get_general_settings_file('top_a1');
        $data['top_a1_link'] = get_general_settings_text('top_a1_link');
        $data['top_a2'] = get_general_settings_file('top_a2');
        $data['top_a2_link'] = get_general_settings_text('top_a2_link');

        $data['facebook'] = get_general_settings_text('facebook');
        $data['twitter'] = get_general_settings_text('twitter');
        $data['youtube'] = get_general_settings_text('youtube');
        $data['google_plus'] = get_general_settings_text('google_plus');
        $data['pinterest'] = get_general_settings_text('pinterest');
        $data['instagram'] = get_general_settings_text('instagram');
        $data['linkedin'] = get_general_settings_text('linkedin');
        $data['meta_title'] = get_general_settings_text('meta_title');
        $data['meta_keyword'] = get_general_settings_text('meta_keyword');
        $data['meta_desc'] = get_general_settings_text('meta_desc');
        $data['footer_text'] = get_general_settings_text('footer_text');
        $data['misc_javascript'] = get_general_settings_text('misc_javascript');
        $data['misc_css'] = get_general_settings_text('misc_css');
        return $data;
    }

    public function setTextTitle($request, $slug)
    {
        Cache::forget('general-settings-text-' . $slug);
        $data = Setting::firstOrCreate([
                'slug' => $slug,]
        );
        $data->text = $request;
        $data->save();
    }

    public function setImage($request, $slug)
    {
        Cache::forget('general-settings-file-' . $slug);
        $path = 'configuration/settings';
        if ($request) {
            $image = Setting::select('file', 'slug')->where('slug', $slug)->first();
            if ($image) {
                Setting::where('slug', $slug)->update(
                    [
                        'file'=>SaveImage::update($request,$path,$image->file)
//                        'file' => $request,
                    ]
                );
            } else {
                $data = Setting::firstOrCreate(['slug' => $slug,]);
//                $data->file = $request;
                $data->file= SaveImage::save($request,$path);
                $data->save();
            }
        }
    }

}
