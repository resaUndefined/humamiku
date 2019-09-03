<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\User;
use DB;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function showResetForm($token = null)
    {
        $email_token = DB::table('password_resets')->where('token', $token)->first();
        if(empty($email_token) || is_null($email_token)){
            abort(404);
            die();
        }else{
            return view('auth.passwords.reset', [
                'token' => $email_token->token,
                'email' => $email_token->email,
            ]);
        }       
    }


    public function reset(Request $request)
    {
        $email_token = DB::table('password_resets')->where([
                                            'token' => $request->token,
                                            'email' => $request->email
                                            ])->first();
        if(empty($email_token) || is_null($email_token)){
            return redirect()->back()
                ->with('message', 'Error, Reset password gagal.')
                ->withInput();
        }else{
            if ($request->isMethod('post')) {
                $password = $request->get('password');
                $password_confirmation = $request->get('password_confirmation');
                $validator = Validator::make($request->all(), [
                        'password' => 'required|min:6',
                        'password_confirmation' => 'required|same:password',
                    ],
                    [
                        'password.required' => 'Password wajib diisi',
                        'password_confirmation.required' => 'Konfirmasi password wajib diisi',
                        'password.min' => 'Minimal password 6 karakter',
                        'password_confirmation.same' => 'Kombinasi password dengan konfirmasi password tidak sama'
                    ]);

                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }else{
                    $user = User::where('email', $email_token->email)->first();
                    $user->password = Hash::make($password);
                    $save_user = $user->save();

                    DB::table('password_resets')->where('token', $request->email)->delete();

                    return redirect()->route('login')->with("status", "Password berhasil di reset!");
                }

            }
            
        } 
        
    }


    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ];
    }
}
