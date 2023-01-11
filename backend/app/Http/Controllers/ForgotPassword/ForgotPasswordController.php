<?php 
  
namespace App\Http\Controllers\ForgotPassword; 
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use DB; 
use Carbon\Carbon; 
use App\Models\User; 
use Mail; 
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
  
class ForgotPasswordController extends Controller
{
  /**
   * Write code on Method
   *
   * @return response()
   */
  public function showForgetPasswordForm()
  {
      //return view('auth.forgetPassword');
  }

  /**
   * Write code on Method
   *
   * @return response()
   */
  public function submitForgetPasswordForm(Request $request)
  {
    $request->validate([
        'email' => 'required|email|exists:users',
    ]);

    $token = Str::random(64);

    DB::table('password_resets')->insert([
        'email' => $request->email, 
        'token' => $token, 
        'created_at' => Carbon::now()
    ]);

    $user = User::where('email', $request->email)->first();

    Mail::send('email.forgetPassword', ['id' => $user->id], function($message) use($request){
        $message->to($request->email);
        $message->subject('Reset Password');
    });

    return back()->with('message', 'We have e-mailed your password reset link!');
  }
  /**
   * Write code on Method
   *
   * @return response()
   */
  public function showResetPasswordForm($token) { 
      return view('auth.forgetPasswordLink', ['token' => $token]);
  }

  /**
   * Write code on Method
   *
   * @return response()
   */
  public function submitResetPasswordForm(Request $request)
  {
    // $request->validate([
    //   // 'email' => 'required|email|exists:users',
    //   'new_password' => 'required|string|min:6|confirmed',
    //   'comfirm_new_password' => 'required'
    // ]);

    $updatePassword = DB::table('password_resets')
                        ->where([
                          'email' => $request->email, 
                          // 'token' => $request->token
                        ])
                        ->first();

    if(!$updatePassword){
      return back()->withInput()->with('error', 'Invalid token!');
    }

    $user = User::where('email', $request->email)
                ->update(['password' => Hash::make($request->new_password)]);

    DB::table('password_resets')->where(['email'=> $request->email])->delete();

    return $user;
  }
}