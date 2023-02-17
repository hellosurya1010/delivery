<?php

namespace App\View\Components\input;

use Illuminate\View\Component;

class InputField extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $id;
    public $label;
    public $type;
    public $name;
    public $placeholder;
    public $value;
    public $required;

    public function __construct($name, $id, $label, $type="text", $placeholder="", $value="", $required=false)
    {
        $this->id = $id;
        $this->label = $label;
        $this->type = $type;
        $this->required = $required;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.input-field');
    }
}
