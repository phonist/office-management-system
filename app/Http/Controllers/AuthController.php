<?php
namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\User;
use Socialite;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;

class AuthController extends Controller
{
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub, Facebook, Google.
     *
     * @return Response
     */
    public function handleProviderCallback($provider,Request $request)
    {
        if (!$request->has('code') || $request->has('denied')) {
            Log::info('Request: '.$request);
            return redirect('/');
        }
        try{
            $provider_user = Socialite::driver($provider)->stateless()->user();
        }catch(Exception $e){
            Log::info($e);
        }

        
        Log::info(json_encode($provider_user));
        $user = $this->findUserByProviderOrCreate($provider, $provider_user);
        auth()->login($user);
        flash('Welcome to Buzzer Office.')->success();

        return redirect()->to('/admin');
    }

    private function findUserByProviderOrCreate($provider, $provider_user)
    {
        Log::info('start find user');
        $user = User::where($provider . '_id', $provider_user->token)
            ->orWhere('email', $provider_user->email)
            ->first();
        if (!$user) {
            Log::info('create user');
            $user = User::create([
                'name' => $provider_user->name,
                'email' => $provider_user->email,
                $provider . '_id' => $provider_user->token,
                'photo' => $provider_user->avatar
            ]);
        } else {
            Log::info('update token');
            // Update the token on each login request
            $user[$provider . '_id'] = $provider_user->token;
            $user['photo'] = $provider_user->avatar;
            $user->save();
        }

        return $user;
    }
}
