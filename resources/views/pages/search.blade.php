@extends('layouts.app')

@section('content')
    @include('layouts.includes.home.nav')
    @include('layouts.includes.home.left_block')
    <div class="main_cont">
        <div class="search_cont">
            <div class="search_cont_inner d_flex fd_column ">
                <h2 class="fs_24 text_center c_darkBlue f_600">I am looking for</h2>
                <div class="range_container_filter">
                    <form action="{{ route('search') }}" method="GET">
                        <div class="range_container_filter">
                            <div class="form_control d_flex align_items_center justify_content_space_between">
                                <div class="form_control_container d_flex">
                                    <input class="form_control_container__time__input" id="fromInput" value="18" min="18" max="99" style="width: 20px" />
                                    <p class="fs_16">years</p>
                                </div>
                                <div class="sliders_control">
                                    <input id="fromSlider" type="range" name="min" value="18" min="18"/>
                                    <input id="toSlider" type="range" name="max" value="99" min="18" max="99"/>
                                </div>
                                <div class="form_control_container d_flex">
                                    <input class="form_control_container__time__input" id="toInput" value="99" min="18" max="99" style="width: 30px; text-align: right"/>
                                    <p class="fs_16">years</p>
                                </div>
                            </div>
                        </div>
                        <div class="search_input_b margin_top_24">
                            <select name="country" id="country" class="form-select  bg-white">
                                <option value="" selected disabled hidden>Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{$country['id']}}" @if(old('country') == $country['id'] ) selected @endif>{{ $country['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="search_input_b margin_top_24">
                            <input id="nick-name" type="text" class="form-control bg-white"
                                   name="nick_name" value="{{ old('nick_name') }}" placeholder="Nickname">
                        </div>
                        <div class="d_flex align_items_center male_female_btns_b margin_top_24">
                            <input type="radio" class="btn-check" name="gender" id="success-outlined" autocomplete="off" value="1" checked>
                            <label class="male_btn c_grey fs_16 sex_btn active_sex_btn text-center" for="success-outlined">Male</label>

                            <input type="radio" class="btn-check" name="gender" id="danger-outlined" value="2" autocomplete="off">
                            <label class="female_btn fs_16 c_grey sex_btn text-center" for="danger-outlined">Female</label>
                        </div>
                        <div class="d_flex align_items_start search_btn_b">
                            <button type="submit" class="bc_darkBlue margin_top_24 c_white search_btn fs_16">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <span style="font-size:30px;cursor:pointer;z-index:1000" class="openBtnSearch" onclick="openNavSearch()">&#9776;</span> --}}
    @if(count($users) > 0)
        <div class="sidenav_search d_flex fd_column justify_content_center mt-5">
            <div class="sidenav_header">
                <h2 class="c_blue fs_24 text_center">Result {{ count($users) }}</h2>
            </div>
            <div class="sidenav_search_body_content">
                @if(count($users) > 0)
                    @foreach($users as $user)
                        <div class="sidenav_search_body_content_item d_flex"  onclick="location.href='{{  route('chat', ['id' => $user['id']]) }}';">
                            @if($user['gender'] == 1)
                                <div class="sex_b d_flex justify_content_center align_items_center bc_azure">
                                    {{-- <img src="{{ asset('images/icons/Male_icon_blue.png') }}" alt=""> --}}
                                    <img class="sex_img" src="{{ asset('images/Unknown_User_Male.png') }}" alt="">
                                </div>
                                <div class="info_b bc_lightBlue d_flex align_items_center justify_content_space_between">
                                    <div>
                                        <p class="fs_18">{{ $user['nick_name'] }}</p>
                                        <p class="fs_14">{{ $user['age'] .' years, '.$user['state'].' / '.$user['country']['name'] }}</p>
                                    </div>
                                    <div class="d_flex align_items_center justify_content_space_between flag_message_b">
                                        <a href="{{ route('chat', ['id' => $user['id']]) }}">
                                            <img src="{{ $user['country']['flag_link'] }}" alt="">
                                        </a>
                                        <span></span>
                                        <a href="{{ route('chat', ['id' => $user['id']]) }}"> <img src="{{ asset('images/icons/message_icon_black.png') }}" alt=""></a>
                                    </div>
                                </div>
                            @else
                                <div class="sex_b d_flex justify_content_center align_items_center  bc_lightRose">
                                    {{-- <img src="{{ asset('images/icons/Female_icon_rose.png') }}" alt=""> --}}
                                    <img class="sex_img" src="{{ asset('images/Unknown_User.png') }}" alt="">
                                </div>
                                <div class="info_b bc_rose d_flex align_items_center justify_content_space_between">
                                    <div>
                                        <p class="fs_18">{{ $user['nick_name'] }}</p>
                                        <p class="fs_14">{{ $user['age'] .' years, '.$user['state'].' / '.$user['country']['name'] }}</p>
                                    </div>
                                    <div class="d_flex align_items_center justify_content_space_between flag_message_b">
                                        <a href="{{ route('chat', ['id' => $user['id']]) }}">
                                            <img src="{{ $user['country']['flag_link'] }}" alt="">
                                        </a>
                                        <span></span>
                                        <a href="{{ route('chat', ['id' => $user['id']]) }}"> <img src="{{ asset('images/icons/message_icon_black.png') }}" alt=""></a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="sidenav_search_mobile d_flex fd_column justify_content_center" id="sidenavSearch">
            <div class="sidenav_header">
                <h2 class="c_blue fs_24 text_center">
                    <a href="javascript:void(0)" onclick="openNavSearch()">Result {{ count($users) }}</a>
                </h2>
                <a href="javascript:void(0)" class="closeBtn" onclick="closeNavSearch()">&times;</a>
            </div>
            <div class="sidenav_search_body_content" id="sidenavSearchList">
                @if(count($users) > 0)
                    @foreach($users as $user)
                        <div class="sidenav_search_body_content_item d_flex"  onclick="location.href='{{  route('chat', ['id' => $user['id']]) }}';">
                            @if($user['gender'] == 1)
                                <div class="sex_b d_flex justify_content_center align_items_center bc_azure">
                                    {{-- <img src="{{ asset('images/icons/Male_icon_blue.png') }}" alt=""> --}}
                                    <img class="sex_img" src="{{ asset('images/Unknown_User_Male.png') }}" alt="">
                                </div>
                                <div class="info_b bc_lightBlue d_flex align_items_center justify_content_space_between">
                                    <div>
                                        <p class="fs_18">{{ $user['nick_name'] }}</p>
                                        <p class="fs_14">{{ $user['age'] .' years, '.$user['state'].' / '.$user['country']['name'] }}</p>
                                    </div>
                                    <div class="d_flex align_items_center justify_content_space_between flag_message_b">
                                        <a href="{{ route('chat', ['id' => $user['id']]) }}">
                                            <img src="{{ $user['country']['flag_link'] }}" alt="">
                                        </a>
                                        <span></span>
                                        <a href="{{ route('chat', ['id' => $user['id']]) }}"> <img src="{{ asset('images/icons/message_icon_black.png') }}" alt=""></a>
                                    </div>
                                </div>
                            @else
                                <div class="sex_b d_flex justify_content_center align_items_center  bc_lightRose">
                                    {{-- <img src="{{ asset('images/icons/Female_icon_rose.png') }}" alt=""> --}}
                                    <img class="sex_img" src="{{ asset('images/Unknown_User.png') }}" alt="">
                                </div>
                                <div class="info_b bc_rose d_flex align_items_center justify_content_space_between">
                                    <div>
                                        <p class="fs_18">{{ $user['nick_name'] }}</p>
                                        <p class="fs_14">{{ $user['age'] .' years, '.$user['state'].' / '.$user['country']['name'] }}</p>
                                    </div>
                                    <div class="d_flex align_items_center justify_content_space_between flag_message_b">
                                        <a href="{{ route('chat', ['id' => $user['id']]) }}">
                                            <img src="{{ $user['country']['flag_link'] }}" alt="">
                                        </a>
                                        <span></span>
                                        <a href="{{ route('chat', ['id' => $user['id']]) }}"> <img src="{{ asset('images/icons/message_icon_black.png') }}" alt=""></a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    @else
        <div class="sidenav_search d_flex justify_content_center">
            <p class="c_darkBlue fs_20 text_center find_result_texts">Here you will find your search results</p>
        </div>
        <div class="sidenav_search_mobile d_flex justify_content_center">
            <p class="c_darkBlue fs_20 text_center find_result_texts">Here you will find your search results</p>
        </div>
    @endif
    @push('js')
        <script type="application/javascript" src="{{ asset('js/range.js') }}"> </script>
        <script type="application/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
        <script type="application/javascript">
            $(document).ready(function () {
                $("#fromSlider").on('input', function () {
                    let number = $("#fromSlider").val();
                    if(number == 100) {
                        number = 99;
                    }
                    $("#fromInput").val(number);
                });
                $("#toSlider").on('input', function () {
                    let number = $("#toSlider").val();
                    $("#toInput").val(number);
                });
            });
        </script>
    @endpush
@endsection
