@extends('layouts.app')
@section('content')

    @include('layouts.includes.home.nav')
    @include('layouts.includes.home.left_block')

    @php
        $notificationUsers = \App\Http\Controllers\FunctionController::getNotificationUsers(auth()->id());
    @endphp

    <div class="inbox_cont">
        <div class="inbox_cont_inner d_flex fd_column">
            <div class="inbox_cont_header d_flex  fd_column justify_content_start">
                <p class="fs_32 f_600 inbox_title">Your Inbox<span class="inbox_title_count">{{ count($notificationUsers ) }}</span></p>
                <div class="d_flex icons_means_b">
                    <div class="d_flex align_items_center  icons_means_b_item">
                        <img src="{{ asset('images/icons/block_user_grey.png') }}" alt="pic">
                        <p class="fs_16 c_grey">means “Block User”</p>
                    </div>
                    <div class="d_flex align_items_center  icons_means_b_item">
                        <img src="{{ asset('images/icons/mark_user_grey.png') }}" alt="pic">
                        <p class="fs_16 c_grey">means “Mark as read”</p>
                    </div>
                </div>
            </div>
            @if( count($notificationUsers ) > 0)
                @foreach($notificationUsers as $user)
                    <div class="inbox_cont_body_item d_flex justify_content_space_between align_items_center inbox_cont_body_item_mss">
                        <div class="d_flex align_items_center inbox_cont_body_item_b1" onclick="location.href='{{  route('chat', ['id' => $user['id']]) }}';" style="cursor: pointer">
                            <div class="sex_b d_flex justify_content_center align_items_center bc_lightGray">
                                @if($user['gender'] == 1)
                                    <img src="{{ asset('images/icons/male_avatar.png') }}" alt="pic" class="">
                                @else
                                    <img src="{{ asset('images/icons/female_avatar.png') }}" alt="pic" class="">
                                @endif
                            </div>
                            <div class="d_flex fd_column">
                                <p class="fs_18">{{ $user['nick_name'] }}</p>
                                <p class="fs_14">{{ $user['age'] .' years, '.$user['state'].' / '.$user['country']['name'] }}</p>
                            </div>
                        </div>
                        <div class="d_flex inbox_cont_body_item_b2 justify_content_space_between align_items_center">
                            <img src="{{ $user['country']['flag_link'] }}" alt="pic">
                            <span class="c_grey fs_24">|</span>
                            <a href="javascript:void(0)" data-id="{{ $user['id'] }}" disabled
                               class="d_flex align_items_center justify_content_center block-user">
                                <img src="{{ asset('images/icons/Block_red.png') }}" alt="pic">
                            </a>
                            <span class="c_grey fs_24">|</span>
                            <a href="javascript:void(0)" data-id="{{ $user['id'] }}"
                               class="d_flex align_items_center justify_content_center mark-as_read">
                                <img src="{{ asset('images/icons/ok_green.png') }}" alt="pic">
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    @push('js')
        <script type="application/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
        <script type="application/javascript">
            $(document).ready(function () {
               $("body").on('click', ".block-user", function () {
                   $(this).off("click");
                   let id = $(this).attr('data-id');
                   $.ajax({
                       type: "POST",
                       url: `{{ route('block.user') }}`,
                       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                       data: {
                           id: id,
                       },
                       success: function(data){
                           location.reload();
                       }
                   });
               });

                $("body").on('click', ".mark-as_read", function () {
                    $(this).off("click");
                    let id = $(this).attr('data-id');
                    $.ajax({
                        type: "POST",
                        url: `{{ route('messages.all.read') }}`,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {
                            id: id,
                        },
                        success: function(data){
                            location.reload();
                        }
                    });
                });
            })
        </script>
    @endpush
@endsection
