<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    protected array $allowedProviders = ['spotify', 'discord'];

    public function redirect(string $provider)
    {
        if (!in_array($provider, $this->allowedProviders)) {
            abort(404);
        }

        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider)
    {
        if (!in_array($provider, $this->allowedProviders)) {
            abort(404);
        }

        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['oauth' => 'No se pudo autenticar con ' . ucfirst($provider) . '. Intenta de nuevo.']);
        }

        $user = User::updateOrCreate(
            [
                'provider'    => $provider,
                'provider_id' => $socialUser->getId(),
            ],
            [
                'name'           => $socialUser->getName() ?? $socialUser->getNickname() ?? 'Usuario',
                'email'          => $socialUser->getEmail() ?? $provider . '_' . $socialUser->getId() . '@noemail.local',
                'avatar'         => $socialUser->getAvatar(),
                'provider_token' => $socialUser->token,
                'password'       => null,
            ]
        );

        Auth::login($user, remember: true);

        return redirect()->intended('/dashboard');
    }
}