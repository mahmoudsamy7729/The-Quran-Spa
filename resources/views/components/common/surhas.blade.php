@php
                                    $western_arabic = array('0','1','2','3','4','5','6','7','8','9');
                                    $eastern_arabic = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');
                                @endphp
                                @foreach ($surahs as $surah)
                                @php
                                    $number_arabic = str_replace($western_arabic, $eastern_arabic, $surah['verses_count']);
                                    $surah_number = str_replace($western_arabic, $eastern_arabic, $surah['id']);
                                @endphp
                                <div class="col-lg-4 col-md-6 col-12  mb-3">
                                    <div class="row justify-content-center">
                                            <div class="col-11 surah-card border rounded">
                                                <a href="{{route('surah',$surah['id'])}}" wire:navigate style="text-decoration:none;">
                                                    <div class="row p-3 justify-content-center">
                                                        <div class="col-2 rounded surah-number-container">
                                                            <span class="surah-number">{{$surah_number}}</span>
                                                        </div>
                                                        <div class="col-4 surah-name-ar">
                                                            @php
                                                                $name_arabic = sprintf('%03d', $surah['id'])
                                                            @endphp
                                                            <h2   style="font-family: surrahname;margin-bottom:0%">{{$name_arabic}}</h2>
                                                            <small  >{{$number_arabic}} ايات</small>
                                                        </div>
                                                        <div class="col-6 surah-name-en" >
                                                            <h6  >{{$surah['name_simple']}}</h6>
                                                            <small  >{{$surah['verses_count']}} Ayahs</small>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                    </div>
                                </div>
                                @endforeach
