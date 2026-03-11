<?php

namespace App\Listeners;

use SocialiteProviders\Manager\SocialiteWasCalled;

class SocialiteListener
{
    public function handle(SocialiteWasCalled $socialiteWasCalled): void
    {
        $socialiteWasCalled->extendSocialite('spotify', \SocialiteProviders\Spotify\Provider::class);
        $socialiteWasCalled->extendSocialite('discord', \SocialiteProviders\Discord\Provider::class);
    }
}