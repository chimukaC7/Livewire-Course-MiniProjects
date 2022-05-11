<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Country;
use Livewire\Component;

class Dropdowns extends Component
{
    public $countries;//for the list
    public $cities;//for the list

    public $country;//for the specific choosen country
    public $city;//for the specific choosen city

    public function mount()
    {
        $this->countries = Country::all();
        $this->cities = collect();//load an empty collection
    }

    public function render()
    {
        return view('livewire.dropdowns');
    }

    //for auto refresh of the dropdowns
    public function updatedCountry($value)//field name
    {
        $this->cities = City::where('country_id', $value)->get();//refresh the cities list
        $this->city = $this->cities->first()->id;//which city is automatically active
    }
}
