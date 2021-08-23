<?php

namespace App\Http\Livewire\Backend\Pages;

use Livewire\Component;

class Create extends Component
{
    public $postTitle,$postUrl,$postSlug;

    private $classPath = 'App\Model\Page';
    public function mount()
    {
        $this->postUrl=env('APP_URL');
    }
    public function updatedPostTitle(){
        $this->postSlug=generateUniqueSlug($this->classPath,$this->postTitle);
        $this->postUrl=generateUniqueUrl($this->classPath,$this->postSlug);
    }
    public function updatedPostSlug(){
        $this->postSlug=generateUniqueSlug($this->classPath,$this->postSlug);
        $this->postUrl=generateUniqueUrl($this->classPath,$this->postSlug);
    }
    public function render()
    {
        return view('livewire.backend.pages.create');
    }
}
