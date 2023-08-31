@php
    $onlineUsers = \App\Http\Controllers\FunctionController::getOnlineUsers();
@endphp
<div class="sidenav sidenav-left">
    <div class="sidenav_header">
        <h2 class="c_blue fs_24 text_center count-online">Online {{ count($onlineUsers) }}</h2>
    </div>
    <div class="sidenav_body_content">
        @if(count($onlineUsers) > 0)
            @foreach($onlineUsers as $onlineUser)
                <div class="sidenav_body_content_item d_flex bc_lightGray" onclick="location.href='{{  route('chat', ['id' => $onlineUser['id']]) }}';">
                    @if($onlineUser['gender'] == 1)
                        <div class="sex_b d_flex justify_content_center align_items_center bc_azure">
                            <img src="{{ asset('images/icons/Male_icon_blue.png') }}" alt="">
                        </div>
                        <div class="info_b bc_lightBlue d_flex align_items_center justify_content_space_between">
                            <div>
                                <p class="fs_18">{{ $onlineUser['nick_name'] }}</p>
                                <p class="fs_14">{{ $onlineUser['age'] .' years, '.$onlineUser['state'].' / '.$onlineUser['country']['name'] }}</p>
                            </div>
                            <div>
                                <img src="{{ $onlineUser['country']['flag_link'] }}" alt="">
                            </div>
                        </div>
                    @else
                        <div class="sex_b d_flex justify_content_center align_items_center bc_lightRose">
                            <img src="{{ asset('images/icons/Female_icon_rose.png') }}" alt="">
                        </div>
                        <div class="info_b bc_rose d_flex align_items_center justify_content_space_between">
                            <div>
                                <p class="fs_18">{{ $onlineUser['nick_name'] }}</p>
                                <p class="fs_14">{{ $onlineUser['age'] .' years, '.$onlineUser['state'].' / '.$onlineUser['country']['name'] }}</p>
                            </div>
                            <div>
                                <img src="{{ $onlineUser['country']['flag_link'] }}" alt="">
                            </div>
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
                    <div class="sidenav_body_content_item d_flex bc_lightGray" onclick="location.href='{{  route('chat', ['id' => $onlineUser['id']]) }}';">
                        @if($onlineUser['gender'] == 1)
                            <div class="sex_b d_flex justify_content_center align_items_center bc_azure">
                                <img src="{{ asset('images/icons/Male_icon_blue.png') }}" alt="">
                            </div>
                            <div class="info_b bc_lightBlue d_flex align_items_center justify_content_space_between">
                                <div>
                                    <p class="fs_18">{{ $onlineUser['nick_name'] }}</p>
                                    <p class="fs_14">{{ $onlineUser['age'] .' years, '.$onlineUser['state'].' / '.$onlineUser['country']['name'] }}</p>
                                </div>
                                <div>
                                    <img src="{{ $onlineUser['country']['flag_link'] }}" alt="">
                                </div>
                            </div>
                        @else
                            <div class="sex_b d_flex justify_content_center align_items_center bc_lightRose">
                                <img src="{{ asset('images/icons/Female_icon_rose.png') }}" alt="">
                            </div>
                            <div class="info_b bc_rose d_flex align_items_center justify_content_space_between">
                                <div>
                                    <p class="fs_18">{{ $onlineUser['nick_name'] }}</p>
                                    <p class="fs_14">{{ $onlineUser['age'] .' years, '.$onlineUser['state'].' / '.$onlineUser['country']['name'] }}</p>
                                </div>
                                <div>
                                    <img src="{{ $onlineUser['country']['flag_link'] }}" alt="">
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
<span style="font-size:30px;cursor:pointer" class="openBtn" onclick="openNav()">&#9776;</span>