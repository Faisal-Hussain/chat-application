
@extends('layouts.app')

@section('content')

    <div class="main">
        <div class="sig_in_cont d_flex">
            <div class="container ">
                <div class="sign_in_cont_blocks d_flex">
                    <div class="sign_in_cont_b1 d_flex fd_column align_items_center">
                        <div class="logo_b">
                            <img src="{{ asset('images/logo.png') }}" alt="">
                        </div>
                        {{-- <h2 class="fs_24 text_center margin_top_32">Lets Start</h2> --}}

                        <div class="sign_in_inputs_blocks d_flex fd_column">
                            <form method="POST" action="{{ route('register.post') }}" id="regForm">
                                @csrf
                                <div class="sign_in_input_b margin_top_24">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon3">
                                             <img src="{{asset('/images/icons/id-card.png')}}" alt="Icon" width="24" height="24">
                                        </span>
                                        <input id="nick-name" type="text" class="form-control bg-white @error('nick_name') is-invalid @enderror"
                                            name="nick_name" value="{{ old('nick_name') }}" placeholder="Type Your Nickname" required autocomplete="name">
                                        @error('nick_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="sign_in_input_b margin_top_24">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon3">
                                            <img src="{{asset('/images/icons/age.png')}}" alt="Icon" width="24" height="24">
                                        </span>
                                        <select name="age" id="age" class="form-select  bg-white  @error('age') is-invalid @enderror">
                                            <option value="" selected disabled hidden>Select Your Age</option>
                                            @if(count($ages) > 0)
                                                @foreach($ages as $age)
                                                    <option value="{{$age}}" @if(old('age') == $age) selected @endif>{{ $age }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('age')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="sign_in_input_b margin_top_24">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon3">
                                            <img src="{{asset('/images/icons/earth.png')}}" alt="Icon" width="24" height="24">
                                        </span>
                                        <select name="country" disabled id="country" style="opacity: 0.5" class="form-select  bg-white  @error('country') is-invalid @enderror country-select">
                                            <option value="" selected disabled hidden>Select Country</option>
                                            @if(count($countries ) > 0)
                                                @foreach($countries as $country)
                                                    <option value="{{ $country['id'] }}"
                                                    @if($currentCountry and  $country['name'] == $currentCountry) selected @endif>
                                                        {{ $country['name'] }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="btn-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="sign_in_input_b margin_top_24">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon3">
                                            <img src="{{asset('/images/icons/location.png')}}" alt="Icon" width="24" height="24">
                                        </span>
                                        <select name="state" id="state" class="form-select  bg-white  @error('state') is-invalid @enderror  state-select">
                                            <option value="" selected disabled hidden>Select State</option>
                                        </select>
                                        @error('state')
                                        <span class="invalid-feedback" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="d_flex align_items_center male_female_btns_b margin_top_24">
                                    <input type="radio" class="btn-check  @error('country') gender @enderror " name="gender" id="success-outlined" autocomplete="off" value="1" @if(old('gender') && old('gender') == 1) checked @elseif(old('gender') == null) checked @endif>
                                    <label class="male_btn c_grey fs_16 sex_btn @if(old('gender') && old('gender') == 1) active_sex_btn @elseif(old('gender') == null) active_sex_btn @endif text-center" for="success-outlined">Male</label>

                                    <input type="radio" class="btn-check" name="gender" id="danger-outlined" value="2" @if(old('gender') && old('gender') == 2) checked @endif autocomplete="off">
                                    <label class="female_btn fs_16 c_grey sex_btn text-center @if(old('gender') && old('gender') == 2) active_sex_btn @endif" for="danger-outlined">Female</label>
                                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="sign_in_input_b margin_top_24">
                                    <div class="captcha">
                                        <span>{!! captcha_img('math') !!}</span>
                                        <button type="button" class="btn btn-success btn-refresh">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="13"  viewBox="0 0 1536 1536">
                                                <path fill="white" d="M1511 928q0 5-1 7q-64 268-268 434.5T764 1536q-146 0-282.5-55T238 1324l-129 129q-19 19-45 19t-45-19t-19-45V960q0-26 19-45t45-19h448q26 0 45 19t19 45t-19 45l-137 137q71 66 161 102t187 36q134 0 250-65t186-179q11-17 53-117q8-23 30-23h192q13 0 22.5 9.5t9.5 22.5zm25-800v448q0 26-19 45t-45 19h-448q-26 0-45-19t-19-45t19-45l138-138Q969 256 768 256q-134 0-250 65T332 500q-11 17-53 117q-8 23-30 23H50q-13 0-22.5-9.5T18 608v-7q65-268 270-434.5T768 0q146 0 284 55.5T1297 212l130-129q19-19 45-19t45 19t19 45z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <input id="captcha" type="text" class="form-control bg-white mt-4 @error('captcha') is-invalid @enderror" placeholder="Enter Captcha" name="captcha">
                                    @error('captcha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <button type="submit" class="bc_darkBlue margin_top_24 c_white chat_btn fs_16">
                                    Start Chat Now
                                </button>
                            </form>
                            {{-- <p class="d-flex justify-content-end mt-2"><a href="{{ route('login') }}">Have you an account?</a></p> --}}
                            <a href="#!" class="w-100 text-center btn-blue margin_top_24 c_white chat_btn fs_16">
                                Become VIP
                            </a>
                        </div>
                        <div class="sign_in_cont_b1_b2 margin_top_32">
                            <div class="text_center fs_16 margin_top_32 desc_b">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                                been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                                galley of type and scrambled it to make a type specimen book. It has survived not only five
                                centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                            </div>
                            <div class="d_grid grid_columns_4fr grid_gab_32 sign_in_cont_b1_b2_items margin_top_32">
                                <div class="sign_in_cont_b1_b2_item d_flex fd_column justify_content_center align_items_center">
                                    <p class="fs_18 text_center">Title</p>
                                    <div class="text_center fs_14">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry
                                    </div>
                                </div>
                                <div class="sign_in_cont_b1_b2_item d_flex fd_column justify_content_center align_items_center">
                                    <p class="fs_18 text_center">Title</p>
                                    <div class="text_center fs_14">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry
                                    </div>
                                </div>
                                <div class="sign_in_cont_b1_b2_item d_flex fd_column justify_content_center align_items_center">
                                    <p class="fs_18 text_center">Title</p>
                                    <div class="text_center fs_14">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry
                                    </div>
                                </div>
                                <div class="sign_in_cont_b1_b2_item d_flex fd_column justify_content_center align_items_center">
                                    <p class="fs_18 text_center">Title</p>
                                    <div class="text_center fs_14">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('layouts.includes.auth.right_block')
                </div>
            </div>
        </div>
        @include('layouts.includes.auth.footer')
    </div>
    @push('style')
    <style>
            .input-group-prepend{
                position: absolute;
                left: 0;
                top: 0;
                bottom: 0;
                display: flex;
                align-items: center;
                padding: 0 10px;
                background-color: #f8f9fa;
                border: 1px solid #ced4da;
                border-radius: 4px 0 0 4px;
            }
        </style>
    @endpush
    @push('js')
        <script src="{{ asset('js/Btn_active.js') }}"> </script>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script>
            let currentCountry = `{{ $currentCountry }}`;

            if(currentCountry) {
                let old_state=null;
                @if(old('state'))
                    old_state="{{old('state')}}";
                @endif
                let id = $('.country-select :selected').val();
                $.ajax({
                    type: "GET",
                    url: "/state/"+id,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {},
                    success: function(data){
                        if(data.length > 0) {
                            let state = $('.state-select');
                            state.find('option').remove();
                            state.append('<option value="" selected disabled hidden>Select State</option>');
                            data.forEach(function(item) {
                                let sel_auto_set_state='';
                                if(old_state != null && item == old_state){
                                    sel_auto_set_state='selected';
                                }
                                let option = `<option `+sel_auto_set_state+` value="${item}">${item}</option>`;
                                state.append(option)
                            });
                        }
                    }
                });
            }

            $(document).ready(function () {
                $('.country-select').on('change', function () {
                    $.ajax({
                        type: "GET",
                        url: "/state/"+$(this).val(),
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {},
                        success: function(data){
                            if(data.length > 0) {
                                let state = $('.state-select');
                                state.find('option').remove();
                                state.append('<option value="" selected disabled hidden>Select State</option>');
                                data.forEach(function(item) {
                                    let option = `<option value="${item}">${item}</option>`;
                                    state.append(option)
                                });
                            }
                        }
                    });
                });

                $(".btn-refresh").click(function(){
                    $.ajax({
                        type:'GET',
                        url:'/refresh_captcha',
                        success:function(data){
                            $(".captcha span").html(data.captcha);
                        }
                    });
                });
            });

        </script>
    @endpush
@endsection
