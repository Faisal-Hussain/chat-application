@extends('layouts.app')
@section('content')
    @include('layouts.includes.home.nav')
    <div class="sidenav">
        <div class="sidenav_body_content ">
            <div class="sidenav_body_content_inner d_flex align_items_center fd_column">
                <img src="{{asset('images/Admin_pic_king.png')}}" alt="" class="user_pic">
                <div class="d_flex align_items_center hide_reveal_b margin_top_16">
                    <p class="fs_16 f_400">Hide country</p>
                    <span class="fs_18 f_500">
                                    <label class="switch">
                                            <input type="checkbox">
                                        <p class="slider round"></p>
                                    </label>
                                </span>
                    <p class="fs_16 f_400">Reveal country</p>
                </div>
                <img src="{{ $admin->country->flag_link }}" alt="" class="margin_top_24 flag_pic">
                <h2 class="fs_24">{{ $admin->nick_name  }}</h2>
                <p class="fs_16 f_700">Owner</p>
                <div class="d_flex align_items_center fs_14 f_400 margin_top_24">
                    <span>{{ $admin->age }}</span> years, <span> {{ $admin->state .'/'. $admin->country->name }}</span>
                </div>
                <div class="d_flex align_items_center hide_reveal_b margin_top_16">
                    <p class="fs_16 f_400">Hide age</p>
                    <span class="fs_18 f_500">
                                    <label class="switch">
                                            <input type="checkbox">
                                        <p class="slider round"></p>
                                    </label>
                                </span>
                    <p class="fs_16 f_400">Reveal age</p>
                </div>
                <div class="d_flex align_items_center  justify_content_center margin_top_24 edit_btn_b">
                    <a href="" class="d_flex align_items_center">
                        <button class="d_flex align_items_center justify_content_center fs_16">Edit
                        </button>
                    </a>
                </div>
                <div class="d_flex align_items_center hide_reveal_b margin_top_24">
                    <p class="fs_16 f_400">Invisible in chat mode</p>
                    <span class="fs_18 f_500">
                                    <label class="switch">
                                            <input type="checkbox">
                                        <p class="slider round"></p>
                                    </label>
                                </span>
                </div>
            </div>

        </div>
    </div>
    <div class="sidenav_mobile">
        <div class="sidenav_mobile_inner" id="sidenavUsers">
            <a href="javascript:void(0)" class="closeBtn" onclick="closeNav()">&times;</a>
            <div class="sidenav_body_content ">
                <div class="sidenav_body_content_inner d_flex align_items_center fd_column">
                    <img src="{{ asset('images/admin_pic.png') }}" alt="" class="user_pic">
                    <img src="{{ $admin->country->flag_link }}" alt="" class="margin_top_24 flag_pic">
                    <h2 class="fs_24">{{ $admin->nick_name  }}</h2>
                    <div class="d_flex align_items_center fs_14 f_400">
                        <span>{{ $admin->age }}</span> years, <span> {{ $admin->state .'/'. $admin->country->name }}</span>>
                    </div>
                    <div class="d_flex align_items_center  justify_content_center margin_top_24 edit_btn_b">
                        <a href="" class="d_flex align_items_center">
                            <button class="d_flex align_items_center justify_content_center fs_16">Edit
                            </button>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <span style="font-size:30px;cursor:pointer" class="openBtn" onclick="openNav()">&#9776;</span>
    <div class="admin_main_cont">
        <div class="admin_screen_cont">
            <div class="admin_screen_cont_inner d_flex justify_content_space_between fd_column">
                <div class="tab d_flex">
                    <button class="tablinks fs_20 c_grey" onclick="openTab(event, 'All Users')" id="allUsers">All
                        Users
                    </button>
                    <button class="tablinks fs_20 c_grey" onclick="openTab(event, 'Normal Users')" id="normalUsers">
                        Normal Users
                    </button>
                    <button class="tablinks fs_20 c_grey" onclick="openTab(event, 'VIP Users')" id="vipUsers">
                        VIP Users
                    </button>
                    <button class="tablinks fs_20 c_grey" onclick="openTab(event, 'Reports')" id="reportsUsers">
                        Reports
                    </button>
                </div>

                <div id="All Users" class="tabcontent">
                    <div class="d_flex justify_content_space_between align_items_center tabContent_content1 margin_top_32">
                        <div class="search_b">
                            <input type="text" class="fs_16" placeholder="Search User">
                            <img src="{{ asset('images/icons/Search_icon_grey.png') }}" alt="search_pic">
                        </div>
                        <div class="add_user_btn_b bc_darkBlue">
                            <button class="add_user_btn fs_16 c_white">Add User</button>
                        </div>
                    </div>
                    <div class="tabContent_content2 margin_top_32">
                        <table id="AllUsers" class="fs_16 users">
                            <tr class="fs_16 f_600">
                                <th>Username</th>
                                <th>Age</th>
                                <th>Country</th>
                                <th>State</th>
                                <th>Gender</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            @if(count($allUsers) > 0)
                                @foreach($allUsers as $user)
                                    <tr class="f_400">
                                        <td>{{ $user['nick_name'] }}</td>
                                        <td>{{ $user['age'] }}</td>
                                        <td>{{ $user['country']['name'] }}</td>
                                        <td>{{ $user['state'] }}</td>
                                        <td>
                                            @if($user['gender'] == 1)
                                                Male
                                            @else
                                                Female
                                            @endif
                                        </td>
                                        <td>
                                            @if($user['roles'][0]['name'] == 'basic')
                                                Normal User
                                            @else
                                                Vip
                                            @endif
                                        </td>
                                        <td class="d_flex c_blue lign_items_center justify_content_center">
                                            <button class="d_flex align_items_center justify_content_center modal-button modal-button1" data-id="{{$user['id']}}">
                                                View<img src="{{ asset('images/icons/Eye_icon.png') }}" alt="">
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                        <div class="d-flex justify-content-end mt-2">
                            {!! $allUsers->appends(['page_name' => 'allUsers' ])->links('vendor.pagination.bootstrap-4') !!}
                        </div>
                    </div>
                </div>

                <div id="Normal Users" class="tabcontent">
                    <div class="d_flex justify_content_space_between align_items_center tabContent_content1 margin_top_32">
                        <div class="search_b">
                            <input type="text" class="fs_16" placeholder="Search User">
                            <img src="{{asset('images/icons/Search_icon_grey.png')}}" alt="search_pic">
                        </div>
                        <div class="add_user_btn_b bc_darkBlue">
                            <button class="add_user_btn fs_16 c_white">Add User</button>
                        </div>
                    </div>
                    <div class="tabContent_content2 margin_top_32">
                        <table id="NormalUsers" class="fs_16 users">
                            <tr class="fs_16 f_600">
                                <th>Username</th>
                                <th>Age</th>
                                <th>Country</th>
                                <th>State</th>
                                <th>Gender</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            @if(count($normalUsers) > 0)
                                @foreach($normalUsers as $user)
                                    <tr class="f_400">
                                        <td>{{ $user['nick_name'] }}</td>
                                        <td>{{ $user['age'] }}</td>
                                        <td>{{ $user['country']['name'] }}</td>
                                        <td>{{ $user['state'] }}</td>
                                        <td>
                                            @if($user['gender'] == 1)
                                                Male
                                            @else
                                                Female
                                            @endif
                                        </td>
                                        <td>
                                            @if($user['roles'][0]['name'] == 'basic')
                                                Normal User
                                            @else
                                                Vip
                                            @endif
                                        </td>
                                        <td class="d_flex c_blue lign_items_center justify_content_center">
                                            <button class="d_flex align_items_center justify_content_center modal-button modal-button1" data-id="{{$user['id']}}">
                                                View<img src="{{ asset('images/icons/Eye_icon.png') }}" alt="">
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                        <div class="d-flex justify-content-end mt-2">
                            {!! $normalUsers->appends(['page_name' => 'normalUsers' ])->links('vendor.pagination.bootstrap-4') !!}
                        </div>
                    </div>
                </div>

                <div id="VIP Users" class="tabcontent">
                    <div class="d_flex justify_content_space_between align_items_center tabContent_content1 margin_top_32">
                        <div class="search_b">
                            <input type="text" class="fs_16" placeholder="Search User">
                            <img src="{{ asset('images/icons/Search_icon_grey.png') }}" alt="search_pic">
                        </div>
                        <div class="add_user_btn_b bc_darkBlue">
                            <button class="add_user_btn fs_16 c_white">Add User</button>
                        </div>
                    </div>
                    <div class="tabContent_content2 margin_top_32">
                        <table id="VIPUsers" class="fs_16 users">
                            <tr class="fs_16 f_600">
                                <th>Username</th>
                                <th>Age</th>
                                <th>Country</th>
                                <th>City</th>
                                <th>Gender</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            @if(count($vipUsers) > 0)
                                @foreach($vipUsers as $user)
                                    <tr class="f_400">
                                        <td>{{ $user['nick_name'] }}</td>
                                        <td>{{ $user['age'] }}</td>
                                        <td>{{ $user['country']['name'] }}</td>
                                        <td>{{ $user['state'] }}</td>
                                        <td>
                                            @if($user['gender'] == 1)
                                                Male
                                            @else
                                                Female
                                            @endif
                                        </td>
                                        <td>
                                            @if($user['roles'][0]['name'] == 'basic')
                                                Normal User
                                            @else
                                                Vip
                                            @endif
                                        </td>
                                        <td class="d_flex c_blue lign_items_center justify_content_center">
                                            <button class="d_flex align_items_center justify_content_center modal-button modal-button1" data-id="{{$user['id']}}">
                                                View<img src="{{ asset('images/icons/Eye_icon.png') }}" alt="">
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                        <div class="d-flex justify-content-end mt-2">
                            {!! $vipUsers->appends(['page_name' => 'vipUsers' ])->links('vendor.pagination.bootstrap-4') !!}
                        </div>
                    </div>
                </div>
                <div id="Reports" class="tabcontent">
                    <div class="d_flex justify_content_space_between align_items_center tabContent_content1 margin_top_32">
                        <div class="search_b">
                            <input type="text" class="fs_16" placeholder="Search User">
                            <img src="{{ asset('images/icons/Search_icon_grey.png') }}" alt="search_pic">
                        </div>
                        <div class="add_user_btn_b bc_darkBlue">
                            <button class="add_user_btn fs_16 c_white">Add User</button>
                        </div>
                    </div>
                    <div class="tabContent_content2 margin_top_32">
                        <table id="report" class="fs_16 users">
                            <tr class="fs_16 f_600">
                                <th>Username</th>
                                <th>Age</th>
                                <th>Country</th>
                                <th>City</th>
                                <th>Gender</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>

                            @if(count($reportUsers ) > 0)
                                @foreach($reportUsers as $report)
                                    <tr class="f_400">
                                        <td>{{ $report['to']['nick_name'] }}</td>
                                        <td>{{ $report['to']['age'] }}</td>
                                        <td>{{ $report['to']['country']['name'] }}</td>
                                        <td>{{ $report['to']['state'] }}</td>
                                        <td>
                                            @if($report['to']['gender'] == 1)
                                                Male
                                            @else
                                                Female
                                            @endif
                                        </td>
                                        <td>
                                            @if($report['to']['roles'][0]['name'] == 'basic')
                                                Normal User
                                            @else
                                                Vip
                                            @endif
                                        </td>
                                        <td class="d_flex c_blue lign_items_center justify_content_center">
                                            <button class="d_flex align_items_center justify_content_center modal-button modal-button2" data-id="{{$report['id']}}">
                                                View<img src="{{ asset('images/icons/Eye_icon.png') }}" alt="">
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                        <div class="d-flex justify-content-end mt-2">
                            {!! $reportUsers->appends(['page_name' => 'reportsUsers' ])->links('vendor.pagination.bootstrap-4') !!}
                        </div>
                    </div>
                </div>
                <!-- Trigger/Open The Modal -->

                <!-- The Modal -->
                <div id="myModal1" class="modal modal-dashboard">
                    <!-- Modal content -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <span></span>
                            <h2 class="fs_24 c_darkBlue">
                                <span class="close">×</span>
                            </h2>
                        </div>
                        <div class="modal-body modal-body_1">
                            <div class="d_flex align_items_center">
                                <p class="fs_18 f_400">Username:</p>
                                <span class="fs_18 f_500 modal-1_name"></span>
                            </div>
                            <div class="d_flex align_items_center">
                                <p class="fs_18 f_400">Age:</p>
                                <span class="fs_18 f_500 modal-1_age"></span>
                            </div>
                            <div class="d_flex align_items_center">
                                <p class="fs_18 f_400">Country:</p>
                                <span class="fs_18 f_500 modal-1_country"></span>
                            </div>
                            <div class="d_flex align_items_center">
                                <p class="fs_18 f_400">State:</p>
                                <span class="fs_18 f_500 modal-1_state"></span>
                            </div>
                            <div class="d_flex align_items_center">
                                <p class="fs_18 f_400">Gender:</p>
                                <span class="fs_18 f_500 modal-1_gender"></span>
                            </div>
                            <div class="d_flex align_items_center">
                                <p class="fs_18 f_400">Status:</p>
                                <span class="fs_18 f_500 modal-1_status"></span>
                            </div>
                            <div class="d_flex align_items_center">
                                <p class="fs_18 f_500">Make as a VIP user</p>
                                <span class="fs_18 f_500">
                                    <label class="switch" id="switch">
                                            <input type="checkbox" class="modal-1_vip">
                                        <p class="slider round"></p>
                                    </label>
                                </span>
                            </div>
                            <input type="hidden" class="user-id">
                            <div class="d_flex fd_column justify_content_start" id="vip_dates_block_select">
                                <p class="fs_18 f_400">Type the date from which user will become VIP</p>
                                <div class="d_flex align_items_center vip_dates_block_select_div">
                                    <input type="date" class="start-data" name="start" placeholder="From" min="{{Carbon\Carbon::today()->format('Y-m-d')}}" required>
                                    -
                                    <input type="date" class="end-data" name="end" placeholder="To" min="{{Carbon\Carbon::today()->addDays(1)->format('Y-m-d')}}" required>
                                    <button class="save_btn bc_darkBlue c_white save-vip_btn">Save</button>
                                </div>
                            </div>
                            <div id="vip_dates_b">
                                <div class="d_flex align_items_center vip_dates_b">
                                    <p class="fs_18 f_400">VIP Available Date:</p>
                                    <div class="fs_18 f_500"><span class="period-start"></span>-<span class="period-end"></span></div>
                                    <button onclick="EditVip()">
                                        <img src="{{ asset('images/icons/Edit_icon.png') }}" alt=""></button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d_flex justify_content_center align_items_center">
                            <button class="d_flex align_items_center justify_content_center c_darkBlue fs_16 f_500 block-unblock_user">
                                <img src="{{ asset('images/icons/Block_red.png') }}"  class="block-unblock_user_image" alt="">
                                <span class="block-unblock_user_text">Block User</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div id="myModal2" class="modal modal-dashboard">
                    <!-- Modal content -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <span></span>
                            <h2 class="fs_24 c_darkBlue">
                                <span class="close">×</span>
                            </h2>
                        </div>
                        <div class="modal-body">
                            <div class="d_flex align_items_center">
                                <p class="fs_18 f_400">Username:</p>
                                <span class="fs_18 f_500 modal-2_name"></span>
                            </div>
                            <div class="d_flex align_items_center">
                                <p class="fs_18 f_400">Age:</p>
                                <span class="fs_18 f_500 modal-2_age"></span>
                            </div>
                            <div class="d_flex align_items_center">
                                <p class="fs_18 f_400">Country:</p>
                                <span class="fs_18 f_500 modal-2_country"></span>
                            </div>
                            <div class="d_flex align_items_center">
                                <p class="fs_18 f_400">State:</p>
                                <span class="fs_18 f_500 modal-2_state"></span>
                            </div>
                            <div class="d_flex align_items_center">
                                <p class="fs_18 f_400">Gender:</p>
                                <span class="fs_18 f_500 modal-2_gender"></span>
                            </div>
                            <div class="d_flex align_items_center">
                                <p class="fs_18 f_400">Status:</p>
                                <span class="fs_18 f_500 modal-2_status"></span>
                            </div>
                            <div class="d_flex fd_column report_block_items">
                                <div class="d_flex align_items_center">
                                    <p class="fs_18 f_400">Report from:</p>
                                    <span class="fs_18 f_500 user_type c_blue">
                                        <a href="" class="modal-2_report_from"></a>
                                    </span>
                                </div>
                                <div class="d_flex align_items_center">
                                    <p class="fs_18 f_400">Report Date:</p>
                                    <span class="fs_18 f_500 modal-2_report_date"></span>
                                </div>
                                <div class="fs_18 f_400 margin_top_8 modal-2_report_message">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer d_flex justify_content_center align_items_center">
                            <button class="d_flex align_items_center justify_content_center c_darkBlue fs_16 f_500 block-unblock_user">
                                <img src="{{ asset('images/icons/Block_red.png') }}" alt=""  class="block-unblock_user_image">
                                <span class="block-unblock_user_text">Block User</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')

        <script type="application/javascript" src="{{ asset('js/modals.js').'?v='.time() }}"></script>
        <script type="application/javascript" src="{{ asset('js/SwitchActive.js').'?v='.time() }}"></script>
        <script type="application/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
        <script type="application/javascript">
            let pageName = `{{ $pageName }}`;
            $(document).ready(function () {
                let urlBlockUser = `{{ asset('images/icons/Block_red.png') }}`;
                let urlUnblockUser = `{{ asset('images/icons/ok_green.png') }}`;
                let genderInfo =  'Male';
                let statusUser = 'Normal User'
                let name = $(".modal-1_name");
                let age = $(".modal-1_age");
                let country = $(".modal-1_country");
                let state = $(".modal-1_state");
                let gender = $(".modal-1_gender");
                let status = $(".modal-1_status");

                let name2 = $(".modal-2_name");
                let age2 = $(".modal-2_age");
                let country2 = $(".modal-2_country");
                let state2 = $(".modal-2_state");
                let gender2 = $(".modal-2_gender");
                let status2 = $(".modal-2_status");
                let reportFrom2 = $(".modal-2_report_from");
                let reportMessage2 = $(".modal-2_report_message");
                let reportDate2 = $(".modal-2_report_date");

                let start = $(".start-data");
                let end = $(".end-data");
                let userId = $(".user-id");
                let periodStart =  $('.period-start');
                let periodEnd =  $('.period-end');
                let blockUnblockUserImage =  $('.block-unblock_user_image');
                let blockUnblockUserText = $('.block-unblock_user_text');
                $('body').on('click', '.modal-button1', function () {
                    $('.modal-1_vip').prop('checked', false);
                    $("#vip_dates_block_select").hide();
                    let id = $(this).attr('data-id');
                    name.text();
                    age.text();
                    country.text();
                    state.text();
                    gender.text();
                    status.text();
                    periodStart.text();
                    periodEnd.text();
                    status.removeClass('active');
                    blockUnblockUserText.text('Block User');
                    blockUnblockUserImage.attr("src", urlBlockUser);
                    $.ajax({
                        type: "GET",
                        url: `{{ route('dashboard.user') }}` + '/' + id,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {},
                        success: function(data){
                           if(data.gender == 2) {
                               genderInfo = 'Female';
                           }
                            if(data.roles[0].name == 'vip') {
                                statusUser = 'Vip';
                                status.addClass('active');
                                periodStart.text(data.period_vip_user.start_date);
                                periodEnd.text(data.period_vip_user.end_date);
                                $("#vip_dates_b").show();
                                $('.modal-1_vip').prop('checked', true);
                            }

                            if(data.blocked == 1) {
                                blockUnblockUserText.text('Unblock User');
                                blockUnblockUserImage.attr("src", urlUnblockUser);
                            }
                            name.text(data.nick_name);
                            age.text(data.age);
                            country.text(data.country.name);
                            state.text(data.state);
                            gender.text(genderInfo);
                            status.text(statusUser);
                            userId.val(data.id);
                            $('#myModal1').show();
                        }
                    });
                });


                $('body').on('click', '.modal-button2', function () {
                    let id = $(this).attr('data-id');
                    name2.text();
                    age2.text();
                    country2.text();
                    state2.text();
                    gender2.text();
                    status2.text();
                    reportFrom2.text();
                    reportFrom2.attr("href", "");
                    blockUnblockUserText.text('Block User');
                    blockUnblockUserImage.attr("src", urlBlockUser);
                    $.ajax({
                        type: "GET",
                        url: `{{ route('dashboard.report') }}` + '/' + id,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {},
                        success: function(data){
                            if(data.to.gender == 2) {
                                genderInfo = 'Female';
                            }
                            if(data.to.roles[0].name == 'vip') {
                                statusUser = 'Vip';
                            }

                            if(data.to.blocked == 1) {
                                blockUnblockUserText.text('Unblock User');
                                blockUnblockUserImage.attr("src", urlUnblockUser);
                            }
                            reportDate2.text(data.date);
                            reportMessage2.text(data.message);
                            reportFrom2.attr("href", `{{ route('chat') }}` + '/' + data.from.id);
                            reportFrom2.text(data.from.nick_name);
                            name2.text(data.to.nick_name);
                            age2.text(data.to.age);
                            country2.text(data.to.country.name);
                            state2.text(data.to.state);
                            gender2.text(genderInfo);
                            status2.text(statusUser);
                            userId.val(data.to.id);
                            $('#myModal2').show();
                        }
                    });

                });


                $("body").on('click', '.close', function () {
                    $('.modal-dashboard').hide();
                });

               $("body").on('change', '.modal-1_vip', function () {
                   if($(this).parents('.modal-body_1').find('.modal-1_status').hasClass('active')) {
                       $("#vip_dates_block_select").hide();
                       if($(this).is(':checked')) {
                           $("#vip_dates_b").show()
                       }else {
                           $("#vip_dates_b").hide()
                       }
                   }else {
                       $("#vip_dates_b").hide();
                       $("#vip_dates_block_select").toggle();
                   }
               });

                $("body").on('click', '.save-vip_btn', function () {
                    start.css({"border": "1px solid rgba(197, 197, 215, 1)"});
                    end.css({"border": "1px solid rgba(197, 197, 215, 1)"});
                   if(start.val() == '' || end.val() == '' ) {
                       start.css({"border": "1px solid red"});
                       end.css({"border": "1px solid red"});
                       return;
                   }
                    $.ajax({
                        type: "POST",
                        url: `{{ route('dashboard.change.role') }}`,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {
                            'id': userId.val(),
                            'start': start.val(),
                            'end': end.val()
                        },
                        success: function(data){
                            location.reload();
                        },
                        errors: function (err) {
                            console.log(err)
                        }
                    });
                });

                $("body").on('click', '.block-unblock_user', function () {
                    $.ajax({
                        type: "POST",
                        url: `{{ route('dashboard.block-or-unblock') }}`,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {
                            'id': userId.val(),
                        },
                        success: function(data){
                            location.reload();
                        },
                        errors: function (err) {
                            console.log(err)
                        }
                    });
                });
            })
        </script>
        <script type="application/javascript" src="{{ asset('js/admin_tabs.js').'?v='.time() }}"></script>
    @endpush
@endsection