@php
    $onlineUsers = \App\Http\Controllers\FunctionController::getOnlineUsers('obj');
@endphp
<div class="sidenav sidenav-left">
    <div class="sidenav_header">
        <h2 class="c_blue fs_24 text_center count-online">Online - {{ count($onlineUsers) }}</h2>
    </div>
    <div class="sidenav_body_content">
        @if(count($onlineUsers) > 0)
            @foreach($onlineUsers as $onlineUser)
                <div class="sidenav_body_content_item d_flex bc_lightGray" onclick="location.href='{{  route('chat', ['id' => $onlineUser->id]) }}';">
                    @if($onlineUser['gender'] == 1)

                        <div class="sex_b d_flex justify_content_center align_items_center bc_azure">
                            @if($onlineUser->hasRole('admin'))
                                <img src="{{ asset('images/icons/admin_badge.png') }}" alt="">
                            @else
                                <img src="{{ asset('images/icons/Male_icon_blue.png') }}" alt="">
                            @endif
                        </div>
                        <div class="info_b bc_lightBlue d_flex align_items_center justify_content_space_between" @if($onlineUser->hasRole('admin')) style="background:url({{asset('images/icons/admin_border.png')}});no-repeat;background-size:cover" @endif>
                            @if($onlineUser->setting)
                                <div>
                                    <p class="fs_18" @if($onlineUser->hasRole('admin')) style="text-align:center" @endif>{{\Illuminate\Support\Str::limit($onlineUser->nick_name,14) }}</p>
                                    <p class="fs_14">
                                        @if($onlineUser->setting->reveal_age == 1)
                                            <span>{{ $onlineUser->age .' years '}}</span>
                                        @endif
                                        @if($onlineUser->setting->reveal_country == 1)
                                            <span>{{$onlineUser->state.' / '.$onlineUser->country->name }}</span>
                                        @endif
                                    </p>
                                </div>
                                @if($onlineUser->setting->reveal_country == 1)
                                    <div>
                                        <img src="{{ $onlineUser->country->flag_link }}" alt="">
                                    </div>
                                @endif
                            @else
                                <div>
                                    <p class="fs_18">{{ \Illuminate\Support\Str::limit($onlineUser->nick_name,14) }}</p>
                                    <p class="fs_14">{{ $onlineUser->age .' years '.$onlineUser->state.' / '.$onlineUser->country->name}}</p>
                                </div>
                                <div>
                                    <img src="{{ $onlineUser->country->flag_link}}" alt="">
                                </div>
                            @endif
                        </div>
                        <div class="mobilename">
                            <p class="fs_18" @if($onlineUser->hasRole('admin')) style="text-align:center" @endif>{{\Illuminate\Support\Str::limit($onlineUser->nick_name, 20, '...')  }}</p>
                        </div>
                    @else
                        <div class="sex_b d_flex justify_content_center align_items_center bc_lightRose" >
                            @if($onlineUser->hasRole('admin'))
                                <img src="{{ asset('images/icons/admin_badge.png') }}" alt="">
                            @else
                                <img src="{{ asset('images/icons/Female_icon_rose.png') }}" alt="">
                            @endif
                        </div>
                        <div class="info_b bc_rose d_flex align_items_center justify_content_space_between" @if($onlineUser->hasRole('admin')) style="background:url({{asset('images/icons/admin_border.png')}});no-repeat;background-size:cover" @endif>
                            <div>
                                <p class="fs_18" @if($onlineUser->hasRole('admin')) style="text-align:center" @endif>{{ \Illuminate\Support\Str::limit($onlineUser->nick_name,14) }}</p>
                                <p class="fs_14">{{ $onlineUser->age .' years, '.$onlineUser->state.' / '.$onlineUser->country->name }}</p>
                            </div>
                            <div>
                                <img src="{{ $onlineUser->country->flag_link }}" alt="">
                            </div>
                        </div>
                        <div class="mobilename">
                            <p class="fs_18" @if($onlineUser->hasRole('admin')) style="text-align:center" @endif>{{\Illuminate\Support\Str::limit($onlineUser->nick_name, 20, '...')  }}</p>
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
</div>
<div class="sidenav_mobile sidenav-left_mobile" >
    <div class="sidenav_mobile_inner" id="sidenavUsers">
        <div class="sidenav_header">
            <h2 class="c_blue fs_24 text_center count-online">Online {{ count($onlineUsers) }}</h2>
            <a href="javascript:void(0)" class="closeBtn" onclick="closeNav()">&times;</a>
        </div>
        <div class="sidenav_body_content">
            @if(count($onlineUsers) > 0)
                @foreach($onlineUsers as $onlineUser)
                    <div class="sidenav_body_content_item d_flex bc_lightGray" onclick="location.href='{{ route('chat', ['id' => $onlineUser->id]) }}';">
                        @if($onlineUser->gender == 1)
                            <div class="sex_b d_flex justify_content_center align_items_center bc_azure">
                                <img src="{{ asset('images/icons/Male_icon_blue.png') }}" alt="">
                            </div>
                            <div class="info_b bc_lightBlue d_flex align_items_center justify_content_space_between">
                                <div>
                                    <p class="fs_18">{{ $onlineUser->nick_name }}</p>
                                    <p class="fs_14">{{ $onlineUser->age .' years, '.$onlineUser->state.' / '.$onlineUser->country->name }}</p>
                                </div>
                                <div>
                                    <img src="{{ $onlineUser->country->flag_link }}" alt="">
                                </div>
                            </div>
                            <div class="mobilename">
                                <p class="fs_18" @if($onlineUser->hasRole('admin')) style="text-align:center" @endif>{{\Illuminate\Support\Str::limit($onlineUser->nick_name, 20, '...')  }}</p>
                            </div>
                        @else
                            <div class="sex_b d_flex justify_content_center align_items_center bc_lightRose">
                                <img src="{{ asset('images/icons/Female_icon_rose.png') }}" alt="">
                            </div>
                            <div class="info_b bc_rose d_flex align_items_center justify_content_space_between">
                                <div>
                                    <p class="fs_18">{{ $onlineUser->nick_name }}</p>
                                    <p class="fs_14">{{ $onlineUser->age .' years, '.$onlineUser->state.' / '.$onlineUser->country->name }}</p>
                                </div>
                                <div>
                                    <img src="{{ $onlineUser->country->flag_link }}" alt="">
                                </div>
                            </div>
                            <div class="mobilename">
                                <p class="fs_18" @if($onlineUser->hasRole('admin')) style="text-align:center" @endif>{{\Illuminate\Support\Str::limit($onlineUser->nick_name, 20, '...')  }}</p>
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
<span style="font-size:30px;cursor:pointer" class="openBtn" onclick="openNav()">&#9776;</span>
