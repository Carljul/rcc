<?php

namespace App\Http\Controllers\Auth;

use DB;
use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/deceased';

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        // return $request->only($this->username(), 'password');
        return ['email' => $request->{$this->username()}, 'password' => $request->password, 'isActive' => 1];
    }

    /**
     * Override login form
     *
     * @return void
     */
    public function showLoginForm(Request $request)
    {
        $user = User::orderBy('id', 'desc')->first();
        return view('auth.login', compact('user'));
    }

    /**
     * Change PIN form
     *
     * @return void
     */
    public function showChangePinForm()
    {
        return view('auth.passwords.change-pin');
    }

    /**
     * Change PIN
     *
     * @param Request $request
     *
     * @return void
     */
    public function changePIN(PasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            $password = Hash::make($request->password);
            $request->user()->update(['password' => $password]);
            DB::commit();
            return redirect()->back()->with('success', ['Successfully updated!', 'success']);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', ['Failed to update!', 'danger']);
        }
    }
}
