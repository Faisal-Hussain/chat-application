<?php
namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showForgetPasswordForm()
    {
        return view('auth.admin.forget_password');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        if($request->email != env('ADMIN_MAIL')) {
            return back()->withInput()->withError('Email not found!');
        }

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);


        try{
            Mail::send('email.forget_password', ['token' => $token], function($message) use($request){
            $message->to( env('ADMIN_MAIL'));
                $message->subject('Reset Password');
            });
        }catch (\Exception $e){
            return back()->withError($e->getMessage());
        }


        return back()->withSuccess('We have e-mailed your password reset link!');
    }


    /**
     * @param $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showResetPasswordForm($token) {

        $info = DB::table('password_resets')->where(['token'=> $token])->first();
        if(!$info) {
            return redirect('admin/login')->withError('Token not found!');
        }
        return view('auth.admin.forget_password_link', ['token' => $token]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        if($request->email != env('ADMIN_MAIL')) {
            return back()->withInput()->withError('Email not found!');
        }

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if(!$updatePassword){
            return back()->withInput()->withError('Invalid token!');
        }

        User::query()->whereHas('roles', function ($q) {
            $q->where('name', 'admin');
        })->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect('admin/login')->withSuccess('Your password has been changed!');
    }
}