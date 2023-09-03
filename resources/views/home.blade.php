@extends('layouts.app')

@section('content')
@push('style')
    {{-- <style>
        @media (max-width: 1250px) {
            .main_cont{
                display: none
            }
        }
    </style> --}}
@endpush
<link rel="stylesheet" href="{{asset('plugin/jquery-confirm-master/dist/jquery-confirm.min.css')}}">
    @include('layouts.includes.home.nav')
    @include('layouts.includes.home.left_block')
    <div class="main_cont_for_welcome">
        <div class="welcome_cont">
            <div class="welcome_cont_inner d_flex fd_column align_items_center justify_content_center">
                <h2 class="fs_24 text_center c_darkBlue f_600">Welcome  @auth {{Auth::user()->nick_name}} @endauth to {{strtoupper(config('app.name'))}}</h2>
                <a class="welcome_cont_inner_item margin_top_32 d_flex align_items_center">
                    <span class="bc_blue"></span>
                    <p class="fs_16 c_darkBlue">You can send 8 photos per day</p>
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
    <script type="application/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('plugin/jquery-confirm-master/dist/jquery-confirm.min.js') }}"></script>
    <script>
        @if(isset($tos_check) && $tos_check == false)
            jQuery.confirm({
                title:"Warning",
                content:'<p>"Access restricted to individuals aged 18 and above. Please confirm you are 18+ to proceed." <br /> <br />  "Zero tolerance for scams, ads, or spam. Engage responsibly for a positive community experience."</p>',
                theme:'modern',
                buttons:{
                    agree:{
                        btnClass:'btn-success',
                        text:'I agree',
                        action:function(){
                            tos_agree(1);
                        }
                    },noagree:{
                        btnClass:'btn-dark',
                        text:'No i refuse',
                        action:function(){
                            tos_agree(2);
                        }
                    }
                }
            })

            function tos_agree(type=1){
                $.ajax({
                    url:"{{route('tos_action')}}",
                    data:{
                        t:type,
                        '_token':"{{csrf_token()}}"
                    },type:"POST",dataType:'json',success:function(d){
                        window.location.reload();
                    }
                })
            }
        @endif
    </script>
    @endpush
@endsection
