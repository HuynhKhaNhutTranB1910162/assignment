<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function redirect($provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider): RedirectResponse|string
    {
        try {
            $socialAccount = Socialite::driver($provider)->user();

            $user = User::updateOrCreate([
                'provider_id' => $socialAccount->getId(),
            ], [
                'email' => $socialAccount->getEmail(),
                'name' => $socialAccount->getName(),
                'provider_id'=> $socialAccount->getId(),
                'is_admin' => 0,
                'image' => $socialAccount->getAvatar(),
                'phone' => fake()->phoneNumber(),
                'password' => Hash::make(Str::random(10)),
                'email_verified_at' => Carbon::now(),
            ]);

            Auth::login($user);

            return redirect('/');
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
