
@php
    $notificationUsers = \App\Http\Controllers\FunctionController::getNotificationUsers(auth()->id());
@endphp

<header class="header bc_darkBlue">
    <div class="container">
        <div class="header_inner d_flex justify_content_space_between align_items_center">
            <a href="{{ route('home') }}" class="logo_b">
                <img src="{{ asset('images/logo_small.png') }}" alt="">
            </a>
            <div class=" header_content_b d_flex align_items_center justify_content_space_between">
                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                    <a href="{{ route('dashboard') }}" class="d_flex align_items_center fs_16 c_white">
                        <p class="fs_16 @if(Illuminate\Support\Facades\Route::currentRouteName() == 'dashboard') c_blue @else  c_white @endif">
                           Dashboard
                        </p>
                    </a>
                @endif
                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                    <a href="{{ route('admin_roles') }}" class="d_flex align_items_center fs_16 c_white">
                        <p class="fs_16 @if(Illuminate\Support\Facades\Route::currentRouteName() == 'admin_roles') c_blue @else  c_white @endif">
                            Permission
                        </p>
                    </a>
                @endif
                <a href="{{ route('search') }}" class="d_flex align_items_center fs_16 c_white">
                    <p class="fs_16 @if(Illuminate\Support\Facades\Route::currentRouteName() == 'search') c_blue @else  c_white @endif">
                        Search
                    </p>
                    <img src="{{ asset('images/icons/search_icon.png') }}" alt="" class="nav-icon">
                </a>
                <a  href="{{ route('chat.history') }}" class="d_flex align_items_center c_white fs_16">
                    <p class="fs_16 @if(Illuminate\Support\Facades\Route::currentRouteName() == 'chat.history') c_blue @else  c_white @endif">
                        Chat History
                    </p>
                    <img src="{{ asset('images/icons/History_icon.png') }}" alt="" class="nav-icon">
                </a>
                <a  href="{{ route('inbox') }}" class="d_flex align_items_center c_white fs_16">
                    <p class="fs_16 @if(Illuminate\Support\Facades\Route::currentRouteName() == 'inbox') c_blue @else  c_white @endif">
                        Inbox
                    </p>
                    <img src="{{ asset('images/icons/Notifications_icon.png') }}" alt=""
                         class="nav-icon @if(count($notificationUsers) > 0) is_notification @endif nav-icon_notification">
                </a>
                <a href="{{ route('logout') }}" class="d_flex align_items_center c_white fs_16" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                    <p class="c_white fs_16">  Logout <img src="{{asset('/images/icons/logout.png')}}" style="width:24px;height:24px;margin-left:2px;"/></p>
                </a>
                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</header>



