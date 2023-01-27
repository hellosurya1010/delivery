<?php

namespace App\View\Components\Input;

use App\Models\City;
use App\Services\CSCService;
use Illuminate\View\Component;

class SelectCity extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $cities;
    public $id;
    public $dropdownParent;
    public $name;

    public function __construct($name, $id, $dropdownParent, $stateId=0, $toSelect=null)
    {
        $this->cities = CSCService::getCities($stateId);
        $this->id = $id;
        $this->name = $name;
        $this->dropdownParent = $dropdownParent;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.select-city');
    }
}
