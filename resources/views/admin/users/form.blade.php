@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{asset('plugin/jquery-confirm-master/dist/jquery-confirm.min.css')}}">
    @include('layouts.includes.home.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="admin_screen_cont" style="margin-top: 120px;width:100%;margin-left:0px">
                    <div class="row">
                        <div class="col-9 col-md-9">
                            <h4 class="text-center" style="text-align: center">Users manager</h4>
                        </div>
                        <div class="col-3">
                            <div class="text-right" style="text-align: right">
                                <a href="{{route('dashboard')}}" class="btn btn-primary btn-lg">Back</a>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <form method="POST">
                        @csrf
                        @csrf
                        @if(Session::has('error'))
                            <div class="alert alert-danger mb-2">{{Session::get('error')}}</div>
                        @endif
                        @if(Session::has('success'))
                            <div class="alert alert-success mb-2">{{Session::get('success')}}</div>
                        @endif
                        <div class="form-group">
                            <label class="fs_18 f_400">Nick Name</label>
                            <input type="text" name="nick_name" @if(isset($user->id)) value="{{$user->nick_name}}" @elseif(old('nick_name')) value="{{old('nick_name')}}" @endif id="nick_name"  class="form-control bg-white">
                        </div>
                        <div class="form-group mt-3">
                            <label class="fs_18 f_400">Username</label>
                            <input type="text" name="username" @if(isset($user->id)) value="{{$user->username}}" @elseif(old('username')) value="{{old('username')}}" @endif id="username" class="form-control bg-white">
                            <span class="text-danger">* If you change username,you have to login with changed username and username is uniqe</span><br />
                            <span class="text-danger">* No space or any special characters</span>
                        </div>
                        <div class="form-group mt-3">
                            <label class="fs_18 f_400">Email</label>
                            <input type="text" name="email" @if(isset($user->id)) value="{{$user->email}}" @elseif(old('email')) value="{{old('email')}}" @endif id="email" class="form-control bg-white">
                            <span class="text-danger">* If you change email,you have to login with changed email and email is uniqe</span><br />
                        </div>
                        <div class="form-group">
                            <label class="fs_18 f_400">Mobile</label>
                            <input type="text" name="mobile" @if(isset($user->id)) value="{{$user->mobile}}" @elseif(old('mobile')) value="{{old('mobile')}}" @endif id="mobile" class="form-control bg-white">
                        </div>
                        <div class="form-group mt-3">
                            @if(isset($user->id))
                                <img src="{{$user->get_avatar()}}" style="width: 48px;height:48px;border-radius:50%"/>
                            @endif
                            <div class="mt-2">
                                <input type="file" name="avatar" id="avatar" class="form-control">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label class="fs_18 f_400">Age</label>
                            <select name="age" id="age" class="form-select  bg-white  @error('age') is-invalid @enderror">
                                <option value="" selected disabled hidden>Select Your Age</option>
                                @if(count($ages) > 0)
                                    @foreach($ages as $age)
                                        <option value="{{$age}}" @if(isset($user->id) && $user->age == $age) selected @endif>{{ $age }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label class="fs_18 f_400">Gender</label>
                            <select name="gender" id="gender" class="form-select">
                                <option value="1" @if(isset($user->id) && $user->gender == 1) selected @endif>Male</option>
                                <option value="2" @if(isset($user->id) && $user->gender == 1) selected @endif>Female</option>
                            </select>
                        </div>
                        <div class="sign_in_input_b margin_top_24">
                            <label class="fs_18 f_400">Country</label>
                            <select name="country" id="country" class="form-select  bg-white  @error('country') is-invalid @enderror country-select">
                                <option value="" selected disabled hidden>Select Country</option>
                                @if(count($countries ) > 0)
                                    @foreach($countries as $country)
                                        <option value="{{ $country['id'] }}"
                                        @if(isset($user->id) && $country['id'] == $user->country_id) selected @endif>
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
                        <div class="sign_in_input_b margin_top_24">
                            <label class="fs_18 f_400">State</label>
                            <select name="state" id="state" class="form-select  bg-white  @error('state') is-invalid @enderror  state-select">
                                <option value="" selected disabled hidden>Select State</option>
                            </select>
                            @error('state')
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        @if(isset($user->id))
                            <div id="change_password" class="mt-3" role="tablist" aria-multiselectable="true">
                                <div class="card">
                                    <div class="card-header" role="tab" id="section1HeaderId">
                                        <h5 class="mb-0">
                                            <a data-toggle="collapse" data-parent="#change_password" href="#section1ContentId" aria-expanded="true" aria-controls="section1ContentId">
                                                Change Password
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="section1ContentId" class="collapse show" role="tabpanel" aria-labelledby="section1HeaderId">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="fs_18 f_400">New Password</label>
                                                <input type="password" name="password"  id="password" class="form-control bg-white">
                                            </div>
                                            <div class="form-group">
                                                <label class="fs_18 f_400">Password Confirmation</label>
                                                <input type="password" name="password_confirmation"  id="password_confirmation" class="form-control bg-white">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label class="fs_18 f_400">Password</label>
                                <input type="password" name="password"  id="password" class="form-control bg-white">
                            </div>
                        @endif
                        @if(isset($user->id))
                            <div class="form-group mt-3">
                                <p class="fs_18 f_400">Current Password:</p>
                                <input type="password" class="form-control bg-white" name="cpassword" id="cpassword">
                            </div>
                        @endif
                        <div class="mt-3 d_flex align_items_center justify_content_center margin_top_24 edit_btn_b">
                            <button type="submit" class="d_flex w-100 btn-block align_items_center justify_content_center c_darkBlue fs_16 f_500">
                                <span class="">Save & Continue</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="{{ asset('js/Btn_active.js') }}"> </script>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script>
            let id = $('.country-select :selected').val();
            let cstate="{{Auth::user()->state}}";
            $.ajax({
                type: "GET",
                url: "/state/{{Auth::user()->country_id}}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {},
                success: function(data){
                    if(data.length > 0) {
                        let state = $('.state-select');
                        state.find('option').remove();
                        state.append('<option value="" selected disabled hidden>Select State</option>');
                        data.forEach(function(item) {
                            let this_sel='';
                            if(cstate == item){
                                this_sel='selected';
                            }
                            let option = `<option `+this_sel+` value="${item}">${item}</option>`;
                            state.append(option)
                        });
                    }
                }
            });
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
