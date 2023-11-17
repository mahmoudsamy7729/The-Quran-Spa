<?php

namespace App\Livewire;

use Livewire\Component;
use Http;
use Config;

class SurahEn extends Component
{

    public $surah ; 
    public $audio ;
    public $name ;
    public $ayah ;
    public $data ;
    public $page = 1 ;
    public function mount($id)
    {
        $this->surah = Http::get(Config::get('services.api.api_url_v4').'/verses/by_chapter/'.$id.'?page=1&words=true&word_fields=text_uthmani')->json();
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
        return view('livewire.surah-en')->layout('components.layouts.default');
    }

    public function nextPage($id)
    {
        $this->page++;
        $this->surah = Http::get(Config::get('services.api.api_url_v4').'/verses/by_chapter/'.$id.'?page='.$this->page.'&words=true&word_fields=text_uthmani')->json();
    }

    public function pervPage($id)
    {
        $this->page--;
        $this->surah = Http::get(Config::get('services.api.api_url_v4').'/verses/by_chapter/'.$id.'?page='.$this->page.'&words=true&word_fields=text_uthmani')->json();
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
