<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use DB;
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
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

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
            $request->user()->update(['password' => $request->password]);
            DB::commit();
            return redirect()->route('home')->with('success', ['Successfully updated!', 'success']);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', ['Failed to update!', 'danger']);
        }
    }
}
