@extends('layouts.app')

@section('content')
    @include('layouts.includes.home.nav')
    @include('layouts.includes.home.left_block')
    <div class="chat_history_cont">
        <div class="chat_history_cont_inner d_flex justify_content_space_between fd_column">
            <img src="{{ asset('images/chat_history_pic.png') }}" alt="pic" class="chat_history_pic">
            <p class="margin_top_24 text_center fs_24 f_600">Here will be you messages from people</p>
        </div>
    </div>
    <div>
        <span style="font-size:30px;cursor:pointer" class="openBtnSearch" onclick="openNavSearch()">&#9776;</span>
        <div class="sidenav_online_users">
            <div class="sidenav_body_content ">
                @if(count($users) > 0)
                    @foreach($users as $user)
                        <div class="sidenav_body_content_item d_flex bc_lightGray" onclick="location.href='{{  route('chat', ['id' => $user['id']]) }}';">
                            @if($user['gender'] == 1)
                                <div class="sex_b d_flex justify_content_center align_items_center bc_azure">
                                    <img src="{{ asset('images/icons/Male_icon_blue.png') }}" alt="">
                                </div>
                                <div class="info_b bc_lightBlue d_flex align_items_center justify_content_space_between">
                                    <div>
                                        <p class="fs_18">{{ $user['nick_name'] }}</p>
                                        <p class="fs_14">{{ $user['age'] .' years, '.$user['state'].' / '.$user['country']['name'] }}</p>
                                    </div>
                                    <div>
                                        <img src="{{ $user['country']['flag_link'] }}" alt="">
                                    </div>
                                </div>
                            @else
                                <div class="sex_b d_flex justify_content_center align_items_center bc_lightRose">
                                    <img src="{{ asset('images/icons/Female_icon_rose.png') }}" alt="">
                                </div>
                                <div class="info_b bc_rose d_flex align_items_center justify_content_space_between">
                                    <div>
                                        <p class="fs_18">{{ $user['nick_name'] }}</p>
                                        <p class="fs_14">{{ $user['age'] .' years, '.$user['state'].' / '.$user['country']['name'] }}</p>
                                    </div>
                                    <div>
                                        <img src="{{ $user['country']['flag_link'] }}" alt="">
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="sidenav_body_content_inner d_flex align_items_center fd_column">
                        <img src="{{ asset('images/chat_.png') }}" alt="" class="user_pic">
                        <div class="text_center fs_16 margin_top_32">You don’t have messages yet</div>
                    </div>
                @endif
            </div>
        </div>
        <div class="sidenav_online_users_mobile" id="sidenavSearch">
            <div class="" style="margin-left: 5%">
                <a href="javascript:void(0)" class="closeBtn" onclick="closeNavSearch()">&times;</a>
            </div>
            <div class="sidenav_search_body_content" id="sidenavUsers">
                @if(count($users) > 0)
                    @foreach($users as $user)
                        <div class="sidenav_body_content_item d_flex bc_lightGray" onclick="location.href='{{  route('chat', ['id' => $user['id']]) }}';">
                            @if($user['gender'] == 1)
                                <div class="sex_b d_flex justify_content_center align_items_center bc_azure">
                                    <img src="{{ asset('images/icons/Male_icon_blue.png') }}" alt="">
                                </div>
                                <div class="info_b bc_lightBlue d_flex align_items_center justify_content_space_between">
                                    <div>
                                        <p class="fs_18">{{ $user['nick_name'] }}</p>
                                        <p class="fs_14">{{ $user['age'] .' years, '.$user['state'].' / '.$user['country']['name'] }}</p>
                                    </div>
                                    <div>
                                        <img src="{{ $user['country']['flag_link'] }}" alt="">
                                    </div>
                                </div>
                            @else
                                <div class="sex_b d_flex justify_content_center align_items_center bc_lightRose">
                                    <img src="{{ asset('images/icons/Female_icon_rose.png') }}" alt="">
                                </div>
                                <div class="info_b bc_rose d_flex align_items_center justify_content_space_between">
                                    <div>
                                        <p class="fs_18">{{ $user['nick_name'] }}</p>
                                        <p class="fs_14">{{ $user['age'] .' years, '.$user['state'].' / '.$user['country']['name'] }}</p>
                                    </div>
                                    <div>
                                        <img src="{{ $user['country']['flag_link'] }}" alt="">
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="sidenav_body_content_inner d_flex align_items_center fd_column">
                        <img src="{{ asset('images/chat_.png') }}" alt="" class="user_pic">
                        <div class="text_center fs_16 margin_top_32">You don’t have messages yet</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @push('js')
    @endpush
@endsection
