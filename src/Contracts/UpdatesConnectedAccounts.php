<?php

namespace Uchup07\FilamentCompanies\Contracts;

use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Socialite\Contracts\User;
use Uchup07\FilamentCompanies\ConnectedAccount;

interface UpdatesConnectedAccounts
{
    /**
     * Update a given connected account.
     */
    public function update(Authenticatable $user, ConnectedAccount $connectedAccount, string $provider, User $providerUser): ConnectedAccount;
}
