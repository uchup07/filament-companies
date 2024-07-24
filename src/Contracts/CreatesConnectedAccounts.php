<?php

namespace Uchup07\FilamentCompanies\Contracts;

use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Uchup07\FilamentCompanies\ConnectedAccount;

interface CreatesConnectedAccounts
{
    /**
     * Create a connected account for a given user.
     */
    public function create(Authenticatable $user, string $provider, ProviderUser $providerUser): ConnectedAccount;
}
