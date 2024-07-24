<?php

namespace Uchup07\FilamentCompanies\Contracts;

use Laravel\Socialite\Contracts\User;

interface ResolvesSocialiteUsers
{
    public function resolve(string $provider): User;
}
