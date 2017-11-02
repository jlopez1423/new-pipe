<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen.
    |
    */

    private $default_role = "User";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware( 'guest', [ 'except' => 'logout' ] );
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view( 'auth.login' );
    }

    /**
     * Redirect the user to the Gooogle authentication page.
     *
     * @return Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver( 'google' )->scopes( ['profile', 'email'] )->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return Response
     */
    public function handleGoogleCallback()
    {
        try
        {
            $socialite_user = Socialite::driver( 'google' )->user();

            $email  = $socialite_user->getEmail();
            $domain = substr( strrchr( $email, '@' ), 1 );

            // validate email domain
            if( ! in_array( $domain, config( 'auth.allowed_email_domains' ) ) )
            {
                throw new \Exception( '"' . ucfirst( $domain ) . '" email domain is not allowed. Please login with a different Google Account: ' . implode( ', ', config( 'auth.allowed_email_domains' ) ) . '.' );
            }

            // check if a user with provided email address already exists
            $user = User::withTrashed()->where( 'email', '=', $email )->first();

            // if user doesn't exit, then create a new one
            if( ! $user )
            {
                $role = \App\Role::where('name', $this->default_role )->firstOrFail();

                $user = User::create( [
                    'first_name' => $socialite_user->user['name']['givenName'],
                    'last_name' => $socialite_user->user['name']['familyName'],
                    'email' => $email,
                    'password' => bcrypt( str_random( 12 ) ),
                    'status' => 'active',
                    'role_id' => $role->id
                ] );
            }
            else
            {
                // check if user account is active
                $this->checkIfActive( $user );
            }

            // log the user in
            auth()->login( $user, true );

            return redirect('/');
        }
        catch( \Exception $e )
        {
            session()->flash( '_flash_error', $e->getMessage() );
        }

        // redirect user back to the login page
        return redirect()->route( 'auth.login' );
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout( Request $request )
    {
        auth()->logout();

        $request->session()->flush();
        $request->session()->regenerate();

        session()->flash( '_flash_info', 'You have been successfully logged out.' );

        return redirect('/');
    }


    /**
     * Check if user account is active, otherwise throw an exception.
     *
     * @param User $user
     */
    public function checkIfActive( User $user )
    {
        // if it's an existing user, then make sure this user is active and can access his account
        switch( $user->status )
        {
            case 'pending':
                $flash_message = "We're still working on your account. Please come back later and check your account status. Once approved, you'll be able to and access your dashboard.";
                break;

            case 'suspended':
                $flash_message = "Your account was suspended. Please contact us for more details.";
                break;

            case 'deleted':
                $flash_message = "Your account was deleted. Please contact us for more details.";
                break;

            default :
                break;
        }

        if( isset( $flash_message ) )
        {
            throw new \Exception( $flash_message );
        }
    }
}
