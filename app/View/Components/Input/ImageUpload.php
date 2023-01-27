<?php

namespace App\View\Components\input;

use Illuminate\View\Component;

class ImageUpload extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public $name;
    public $label;

    public function __construct($name, $label,  $id)
    {
        $this->name = $name;
        $this->label = $label;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.image-upload');
    }
}
