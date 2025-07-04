<?php

namespace App\View\Components\Forma;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Str;

class FileUpload extends Component
{
    public $id;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $sm = null,
        public $md = null,
        public $lg = null,
        public $name = null,
        public $placeholder = null,
        public $title = null,
        public $value = null,
        public $customClass = null,
        public $required = null
    )
    {
        $this->id = Str::random(8);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components._Forma.file-upload');
    }
}
