<div>
    <x-slot name="title">
        {{'surah '.$data['name']}}
    </x-slot>
@php
    $western_arabic = array('0','1','2','3','4','5','6','7','8','9');
    $eastern_arabic = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
@endphp
<main style="overflow-x: hidden">
    <div class="row justify-content-center"  style="padding-top: 2rem">
        <div class="col-md-3 col-6 d-flex justify-content-center rounded-pill p-2 themes-div" >
            <a role="button" class="btn btn-primary col-6 rounded-pill active-button tra-div "  style="background: none;border: none;outline: none;" href="{{route('surah-en',$data['id'])}}" wire:navigate>Translation</a>
            <a role="button"  class="btn btn-primary col-6 rounded-pill  tra-div"  style="background: none;border: none;outline: none;" href="{{route('surah',$data['id'])}}" wire:navigate>Reading</a>
        </div>
    
        <div class="col-12">
            <input type="hidden" value="{{$data['id']}}" id="surah-id">

            @php
            $name_arabic = sprintf('%03d', $data['id'])
            @endphp

            
            <p style="font-family: surrahname;text-align:center;font-size:4rem">{{$name_arabic}}sura</p>
            <h1 style="font-family: quran; text-align:center">بِسْمِ ٱللَّهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ</h1>
            <div class="row justify-content-center">
                <div class="col-md-4 col-10">
                    <a href="#" onclick="listen()"  role="button" class="listen-surah surah-info" style="text-decoration: none;float:left;padding:5px;font-weight:bold;" ><i class="fa-solid fa-circle-info me-2"></i>Surah Info </a>
                    <a href="#" onclick="listen()" id="listen" role="button" class="listen-surah" style="text-decoration: none;float:right;padding:5px;" data-value="{{$data['audio']['audio_url']}}"> <i class="fa-solid fa-headphones me-2"></i>الاستماع</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-8 col-10 mt-3" style="font-family: quran;">

                @foreach ($surah['verses'] as $ayah)
                <div class="border-top border-bottom py-4">
                    <h4 class="text-end mb-4">
                        @foreach ($ayah['words'] as $word)
                            {{$word['text']}}
                        @endforeach
                    </h4>
                    <h4 class="text-start">
                        @foreach ($ayah['words'] as $word)
                            {{$word['translation']['text']}}
                        @endforeach
                    </h4>
                </div>
                    
                @endforeach
            <small id="page-num">{{$page}}</small>
            @if ($surah['pagination']['total_pages'] !=1)
            <div class="row justify-content-center" style="direction: rtl;margin-bottom: 1rem;" wire:ignore>
                <button type="button" class="btn next-surah  col-5 ms-3" id="next-page"  onclick="next();"wire:click="nextPage({{$data['id']}})" > <i class="fa-solid fa-angle-right ms-2" style="margin-bottom: -2px;"></i>الصفحة التالية  </button>
                <button type="button" class="btn next-surah  col-5 d-none" id="perv-page" onclick="perv()" wire:click="pervPage({{$data['id']}})">الصفحة السابقة <i class="fa-solid fa-angle-left me-2" style="margin-bottom: -2px;"></i></button>
            </div>
            @endif
            
            <div class="row justify-content-center" style="direction: rtl;margin-bottom: 4rem;">
                @if ($data['id'] != 114)
                    <a role="button" href="{{route('surah',$data['id']+1)}}" wire:navigate class="btn next-surah col-5 ms-3" id="next-surah"><i class="fa-solid fa-angle-right ms-2" style="margin-bottom: -2px;"></i>السورة التالية </a>
                @endif
                @if ($data['id'] != 1)
                    <a role="button" href="{{route('surah',$data['id']-1)}}" wire:navigate class="btn next-surah  col-5"id="prev-surah">السورة السابقة <i class="fa-solid fa-angle-left me-2" style="margin-bottom: -2px;"></i></a>
                @endif

            </div>
            
            <hr>
            
            
          
            
        </div>

    </div>
</main>
    
@section('script-func')
<script>
    var numberOfPages = JSON.parse("{{ json_encode($surah['pagination']['total_pages']) }}");
    function translation()
    {
        var reading = document.getElementById('reading');
        var translation = document.getElementById('translation');
        reading.classList.remove("active-button");
        translation.classList.add("active-button");
    }
    function reading()
    {
        var reading = document.getElementById('reading');
        var translation = document.getElementById('translation');
        reading.classList.add("active-button");
        translation.classList.remove("active-button");
    }
    function listen()
    {
        var audio_div =  document.getElementById('audio-div');
        var audio = document.getElementById('surah');
        var source = document.getElementById('audioSource');
        source.src = document.getElementById('listen').getAttribute('data-value');
        console.log(document.getElementById('listen').getAttribute('data-value'));
        audio_div.classList.remove("d-none");
        audio.load();
        audio.play();
    }
    function next()
    {
        window.scrollTo(0, 0);
        var PervPage = document.getElementById('perv-page');
        PervPage.classList.remove('d-none');
        var NextPage = document.getElementById('next-page');
        if(@this.page+1 == numberOfPages)
        {
            NextPage.classList.add('d-none');
        }

    }
    function perv()
    {
        window.scrollTo(0, 0);
        var PervPage = document.getElementById('perv-page');
        var NextPage = document.getElementById('next-page');
        if( @this.page-1 == 1 )
        {
            PervPage.classList.add('d-none');
        }
        NextPage.classList.remove('d-none');

    }
</script>
@endsection

</div>