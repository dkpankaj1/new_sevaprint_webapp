<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ImageUpload extends Component
{
    public $id;
    public $name;
    public $previewUrl;

    public function __construct($id, $name, $previewUrl = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->previewUrl = $previewUrl;
    }

    public function render(): View|Closure|string
    {
        return view('components.image-upload');
    }
}
