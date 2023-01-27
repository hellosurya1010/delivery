<?php

namespace App\View\Components\Input;

use App\Models\State;
use App\Services\CSCService;
use Illuminate\View\Component;

class SelectState extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public $dropdownParent;
    public $name;
    public $targetCityId;
    public $states;

    public function __construct($countryId=0, $name, $id, $dropdownParent, $toSelect=null, $targetCityId=0)
    {
        $this->states = CSCService::getStates($countryId);
        $this->id = $id;
        $this->name = $name;
        $this->targetCityId = $targetCityId;
        $this->dropdownParent = $dropdownParent;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.select-state');
    }
}
