<?php

namespace App\Livewire;

use Livewire\Component;
use Http;
use Config;

class Surah extends Component
{

    public $surah ; 
    public $audio ;
    public $name ;
    public $ayah ;
    public $data ;
    public $page = 1 ;
    public function mount($id)
    {
        $this->surah = Http::get(Config::get('services.api.api_url_v3').'/chapters/'.$id.'/verses?page=1')->json();
        $this->audio = $this->GetAudio($id);
        $this->name =  $this->GetSurahName($id);
        $this->data = [
            'audio' => $this->audio,
            'id'    => $id,
            'name'  => $this->name,
        ];
    }
    public function render()
    {
        return view('livewire.surah')->layout('components.layouts.default');
    }
    public function nextPage($id)
    {
        $this->page++;
        $this->surah = Http::get(Config::get('services.api.api_url_v3').'/chapters/'.$id.'/verses?page='.$this->page)->json();
    }

    public function pervPage($id)
    {
        $this->page--;
        $this->surah = Http::get(Config::get('services.api.api_url_v3').'/chapters/'.$id.'/verses?page='.$this->page)->json();
    }

    public function GetAudio($id)
    {
        $audio = Http::get(Config::get('services.api.api_url_v4').'/chapter_recitations/7/'.$id)->json()['audio_file'];
        return $audio;
    }
    public function GetSurahName($id)
    {
        $name = Http::get(Config::get('services.api.api_url_v4').'/chapters/'.$id.'?language=en')->json()['chapter']['name_simple'];
        return $name;
    }
}
