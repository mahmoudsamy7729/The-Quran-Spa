<?php

namespace App\Livewire;

use Livewire\Component;
use Http;
use Config;

class Homepage extends Component
{
    public function render()
    {
        $surahs = Http::get(Config::get('services.api.api_url_v4').'/chapters?language=en')->json()['chapters'];
        return view('livewire.homepage',compact('surahs'))->layout('components.layouts.default');
    }
}
