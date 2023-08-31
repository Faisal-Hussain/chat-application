@extends('layouts.app')

@section('content')
    @include('layouts.includes.home.nav')
    @include('layouts.includes.home.left_block')
    <div class="main_cont">
        <div class="welcome_cont">
            <div class="welcome_cont_inner d_flex fd_column align_items_center justify_content_center">
                <h2 class="fs_24 text_center c_darkBlue f_600">Welcome to Lorem</h2>
                <a class="welcome_cont_inner_item margin_top_32 d_flex align_items_center">
                    <span class="bc_blue"></span>
                    <p class="fs_16 c_darkBlue">You can send 5 photos per day</p>
                </a>
                <a class="welcome_cont_inner_item margin_top_32 d_flex align_items_center">
                    <span class="bc_blue"></span>
                    <p class="fs_16 c_darkBlue">You can’t send links</p>
                </a>
                <a class="welcome_cont_inner_item margin_top_32 d_flex align_items_center">
                    <span class="bc_blue"></span>
                    <p class="fs_16 c_darkBlue">You can’t send phone numbers</p>
                </a>
            </div>
        </div>
    </div>
    @push('js')
    @endpush
@endsection
