<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function redirectToProvider( $provider ) {
        return Socialite::driver( $provider )->redirect();
    }

    public function handleProviderCallback( $provider ) {
        try {
            if ( $provider == 'google' ) {
                $user = Socialite::driver( $provider )->stateless()->user();
            }else {
                $user = Socialite::driver( $provider )->fields(
                    [
                        'id',
                        'name',
                        'first_name',
                        'last_name',
                        'email',
                    ]
                )->user();
            }

        } catch ( \Exception $e ) {
            return redirect()->to( '/login' );
        }

        $authUser = $this->findOrCreateUser( $user, $provider );

            auth()->login( $authUser, true );

        return redirect()->to( '/' );
    }

    private function findOrCreateUser( $socialLiteUser, $key ) {
        $email = $key != 'facebook' ? $socialLiteUser->email : $socialLiteUser->user['email'];


        if ( $authUser = User::where( 'email', $email )->first() ) {
            return $authUser;
        }

        $user = User::create( [
            'f_name'  => $key != 'facebook' ? $socialLiteUser->user['name'] : $socialLiteUser->user['first_name'],
            'l_name'   => $key != 'facebook' ? $socialLiteUser->user['name'] : $socialLiteUser->user['last_name'],
            'email'       => $key != 'facebook' ? $socialLiteUser->email : $socialLiteUser->user['email'],
            'password'    => Hash::make(\Str::random($socialLiteUser->user['email'])),
            'remember_token' => base64_encode($key != 'facebook' ? $socialLiteUser->email : $socialLiteUser->user['email']),
        ] );

        return $user;



    }
}
