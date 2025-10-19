<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver($this->provider())->redirect();
    }

    public function callback(): RedirectResponse
    {
        $oauthUser = Socialite::driver($this->provider())->user();

        $user = User::query()->firstOrCreate(
            ['email' => $oauthUser->getEmail()],
            [
                'name' => $oauthUser->getName() ?: $oauthUser->getNickname() ?: $oauthUser->getEmail(),
                'password' => Hash::make(Str::random(32)),
                'avatar' => $oauthUser->getAvatar(),
            ]
        );

        Auth::login($user, true);

        return redirect()->intended(route('admin.dashboard'));
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }

    protected function provider(): string
    {
        $provider = config('services.oauth.provider');
        $config = config("services.{$provider}", []);

        if (empty($provider) || empty(data_get($config, 'client_id')) || empty(data_get($config, 'client_secret'))) {
            abort(500, __('OAuth provider misconfigured. Please check your services.php setup.'));
        }

        return $provider;
    }
}
