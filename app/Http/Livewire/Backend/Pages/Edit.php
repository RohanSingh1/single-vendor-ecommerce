<?php

namespace App\Http\Livewire\Backend\Pages;

use App\helpers\CheckExistingSlug;
use App\helpers\CheckExistingUrl;
use Livewire\Component;

class Edit extends Component
{
    public $page;
    public $postTitle, $postUrl, $postSlug;
    private $classPath = 'App\Model\Page';

    public function mount($page)
    {
        $this->page = $page;
        $this->postTitle = $this->page->post_title;
        $this->postUrl = $this->page->url;
        $this->postSlug = $this->page->slug;
    }
//    public function updatedPostTitle(){
//        $this->postSlug=generateUniqueSlug($this->classPath,$this->postTitle);
//        $this->postUrl=generateUniqueUrl($this->classPath,$this->postSlug);
//    }
    public function updatedPostSlug()
    {
        $this->postSlug = CheckExistingSlug::check($this->classPath, $this->postSlug, $this->page->slug);
        $this->postUrl = CheckExistingUrl::check($this->classPath, $this->postSlug, $this->page->url);
    }

    public function render()
    {
        return view('livewire.backend.pages.edit');
    }
}
