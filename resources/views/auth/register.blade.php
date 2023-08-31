
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
                        <h2 class="fs_24 text_center margin_top_32">Lets Start</h2>

                        <div class="sign_in_inputs_blocks d_flex fd_column">
                            <form method="POST" action="{{ route('register.post') }}" id="regForm">
                                @csrf
                                <div class="sign_in_input_b margin_top_24">
                                    <input id="nick-name" type="text" class="form-control bg-white @error('nick_name') is-invalid @enderror"
                                           name="nick_name" value="{{ old('nick_name') }}" placeholder="Type Your Nickname" required autocomplete="name">
                                    @error('nick_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="sign_in_input_b margin_top_24">
                                    <select name="age" id="age" class="form-select  bg-white  @error('age') is-invalid @enderror">
                                        <option value="" selected disabled hidden>Select Your Age</option>
                                        @if(count($ages) > 0)
                                            @foreach($ages as $age)
                                                <option value="{{$age}}">{{ $age }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="sign_in_input_b margin_top_24">
                                    <select name="country" id="country" class="form-select  bg-white  @error('country') is-invalid @enderror country-select">
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
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="sign_in_input_b margin_top_24">
                                    <select name="state" id="state" class="form-select  bg-white  @error('state') is-invalid @enderror  state-select">
                                        <option value="" selected disabled hidden>Select State</option>
                                    </select>
                                    @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="d_flex align_items_center male_female_btns_b margin_top_24">
                                    <input type="radio" class="btn-check  @error('country') gender @enderror " name="gender" id="success-outlined" autocomplete="off" value="1" checked>
                                    <label class="male_btn c_grey fs_16 sex_btn active_sex_btn text-center" for="success-outlined">Male</label>

                                    <input type="radio" class="btn-check" name="gender" id="danger-outlined" value="2" autocomplete="off">
                                    <label class="female_btn fs_16 c_grey sex_btn text-center" for="danger-outlined">Female</label>
                                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <button type="submit" class="bc_darkBlue margin_top_24 c_white chat_btn fs_16">
                                    Start Chat Now
                                </button>
                            </form>
                            <a href="{{route('login.admin')}}">
                                <button class="margin_top_24 c_blue become_user_btn login_admin_btn fs_16 f_500">Login as Admin</button>
                            </a>
                            <p class="d-flex justify-content-end mt-2"><a href="{{ route('login') }}">Have you an account?</a></p>
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
    @push('js')
        <script src="{{ asset('js/Btn_active.js') }}"> </script>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script>
            let currentCountry = `{{ $currentCountry }}`;

            if(currentCountry) {
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
                                let option = `<option value="${item}">${item}</option>`;
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
            });

        </script>
    @endpush
@endsection