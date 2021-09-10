<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSettingsRequest;
use App\Model\Setting;
use App\Helpers;
use App\Repositories\SettingsRepositoryInterface;
use Illuminate\Http\Request;
use File;

class SettingController extends Controller
{
    public function __construct(SettingsRepositoryInterface $general)
    {
        $this->general = $general;
        $this->middleware('permission:setting-list');
        $this->middleware('permission:setting-edit', ['only' => ['edit', 'update']]);
    }

    public function index()
    {
        $data = $this->general->all();
//        $data['image_post_max_size'] = image_post_max_size() / 1024;
//        $data['file_post_max_size'] = file_post_max_size() / 1024;
//        $data['site_logo'] = site_logo();
        return view('backend.setting.index', $data);
    }

    public function store(CreateSettingsRequest $request)
    {
        $this->general->setTextTitle($request->site_title, 'site_title');
        $this->general->setTextTitle($request->address, 'address');
        $this->general->setTextTitle($request->phone_no, 'phone_no');
        $this->general->setTextTitle($request->tagline, 'tagline');
        $this->general->setTextTitle($request->ac_email, 'ac_email');
        $this->general->setTextTitle($request->facebook, 'facebook');
        $this->general->setTextTitle($request->twitter, 'twitter');
        $this->general->setTextTitle($request->youtube, 'youtube');
        $this->general->setTextTitle($request->google_plus, 'google_plus');
        $this->general->setTextTitle($request->pinterest, 'pinterest');
        $this->general->setTextTitle($request->instagram, 'instagram');
        $this->general->setTextTitle($request->linkedin, 'linkedin');
        $this->general->setTextTitle($request->shipping_price, 'shipping_price');
        $this->general->setTextTitle($request->front_info1, 'front_info1');
        $this->general->setTextTitle($request->front_info2, 'front_info2');
        $this->general->setTextTitle($request->front_info3, 'front_info3');
        $this->general->setImage($request->top_a1, 'top_a1');
        $this->general->setTextTitle($request->top_a1_link, 'top_a1_link');
        $this->general->setImage($request->top_a2, 'top_a2');
        $this->general->setTextTitle($request->top_a2_link, 'top_a2_link');
        $this->general->setTextTitle($request->meta_title, 'meta_title');
        $this->general->setTextTitle($request->meta_keyword, 'meta_keyword');
        $this->general->setTextTitle($request->meta_desc, 'meta_desc');
        $this->general->setTextTitle($request->misc_javascript, 'misc_javascript');
        $this->general->setTextTitle($request->misc_css, 'misc_css');
        $this->general->setTextTitle($request->footer_text, 'footer_text');
        $this->general->setImage($request->site_logo_1, 'site_logo_1');
        $this->general->setImage($request->site_logo_2, 'site_logo_2');
        $this->general->setImage($request->favicon, 'favicon');
        //map code 
        $this->general->setTextTitle($request->map_code, 'map_code');
        toast(__('global.data_update'),'success');
        return redirect()->back();
    }

}
