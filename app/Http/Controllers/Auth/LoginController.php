<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Validator;

class LoginController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  protected $redirectTo = '/dashboard';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function login(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required',
      'password' => 'required',
    ]);

    if ($validator->fails()) {
      $errors = '';
      $validationErrors = json_decode(json_encode($validator->errors()), true);
      foreach ($validationErrors as $error) {
        $errors .= $error[0];
      }
      return ['error' => true, 'message' => $errors];
    }

    $attempt = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
    if ($attempt) {
      return ['error' => false, 'message' => 'Welcome!'];
    } else {
      return ['error' => true,  'message' => 'Invalid Credentials.'];
    }
  }
}
