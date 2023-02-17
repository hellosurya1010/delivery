<?php

namespace App\View\Components\input;

use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public $label;
    public $options;
    public $name;
    public $toSelect;
    public $dropdownParent;
    public $selectOption;

    public function __construct($name, $id, $label, $options=[], $toSelect="", $dropdownParent='', $selectOption = true)
    {
        $this->id = $id;
        $this->label = $label;
        $this->options = $this->renderOptions($options, $toSelect);
        $this->name = $name;
        $this->dropdownParent = $dropdownParent;
        $this->selectOption = $selectOption;
        $this->toSelect = $toSelect;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */

    public function renderOptions($options, $toSelect)
    {
        $html =  [];
        if(is_array($options)){
            foreach ($options as $value => $text) {
                array_push($html, "<option " . ($toSelect == $value ? "selected" : "") ." value='$value'>$text</option>");
            }
            $html = implode('', $html);
        }else if (is_string($options)) {
            $html = $options;
        }
        return $html;
    }

    public function render()
    {
        return view('components.input.select');
    }
}
