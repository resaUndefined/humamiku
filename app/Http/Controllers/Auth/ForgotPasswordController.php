<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Validator;
use Illuminate\Http\Request;
use App\User;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Password;
use App\Notifications\ResetPasswordNotification;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function showLinkRequestForm(){
        return view('auth.passwords.email');
    }


    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ],
            [
                'email.required' => 'Harap masukkan email anda',
                'email.email' => 'Format email tidak sesuai'
            ]);

        if ($validator->fails()) {
            return redirect()->route('password.reset')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('email', $request->email)->first();

        if(empty($user)){
            $email['email'] = "Maaf kami tidak bisa menemukan email anda di sistem kami";
            return redirect()->route('password.reset')
                ->withErrors($email)
                ->withInput();
        }else{
            $email_token = DB::table('password_resets')->where('email', $request->email)->first();
            if(empty($email_token)){
                $token = strtolower(str_random(128));
                DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]);
            }else{
                $token = strtolower(str_random(128));
                DB::table('password_resets')->where('email', $request->email)->update(['token' => $token]);
            }
 
            $user->notify(new ResetPasswordNotification($token));

            return redirect()->route('password.reset')
                ->with('status', 'Kami telah mengirim link reset password di email anda!');
        }
        
    }
}
