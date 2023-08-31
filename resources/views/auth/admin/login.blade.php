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
                        <h2 class="fs_24 text_center margin_top_32">Sign in</h2>
                        <div class="sign_in_inputs_blocks d_flex fd_column">
                            <form method="POST" action="{{ route('login.post.admin') }}">
                                @csrf
                                <div class="sign_in_input_b margin_top_24">
                                    <input id="nick-name" type="text" class="form-control bg-white @error('nick_name') is-invalid @enderror"
                                           name="nick_name" value="{{ old('nick_name') }}" placeholder="Nickname" required autocomplete="name" autofocus>
                                    @error('nick_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="sign_in_input_b margin_top_24">
                                    <input id="password" type="password" class="form-control  bg-white @error('password') is-invalid @enderror"
                                           name="password" required autocomplete="new-password" placeholder="Password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <button type="submit" class="bc_darkBlue margin_top_24 c_white chat_btn fs_16">Sign in</button>
                            </form>
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
        <script src="{{ asset('js/jquery.min.js') }}"></script>
    @endpush
@endsection
