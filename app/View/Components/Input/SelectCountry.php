<?php

namespace App\View\Components\Input;

use App\Models\Country;
use Illuminate\View\Component;

class SelectCountry extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $countires;
    public $id;
    public $dropdownParent;
    public $name;
    public $targetStateId;

    public function __construct($name, $id, $dropdownParent, $targetStateId='')
    {
        $this->id = $id;
        $this->name = $name;
        $this->targetStateId = $targetStateId;
        $this->dropdownParent = $dropdownParent;
        $this->countires = Country::all()->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.select-country');
    }
}
