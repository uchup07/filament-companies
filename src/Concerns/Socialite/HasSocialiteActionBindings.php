<?php
namespace Uchup07\FilamentCompanies\Concerns\Socialite;

use Uchup07\FilamentCompanies\Contracts\CreatesConnectedAccounts;
use Uchup07\FilamentCompanies\Contracts\CreatesUserFromProvider;
use Uchup07\FilamentCompanies\Contracts\GeneratesProviderRedirect;
use Uchup07\FilamentCompanies\Contracts\HandlesInvalidState;
use Uchup07\FilamentCompanies\Contracts\ResolvesSocialiteUsers;
use Uchup07\FilamentCompanies\Contracts\SetsUserPasswords;
use Uchup07\FilamentCompanies\Contracts\UpdatesConnectedAccounts;

trait HasSocialiteActionBindings
{
    /**
     * Register a class / callback that should be used to resolve the user for a Socialite Provider.
     */
    public static function resolvesSocialiteUsersUsing(string $class): void
    {
        app()->singleton(ResolvesSocialiteUsers::class, $class);
    }

    /**
     * Register a class / callback that should be used to create users from social providers.
     */
    public static function createUsersFromProviderUsing(string $class): void
    {
        app()->singleton(CreatesUserFromProvider::class, $class);
    }

    /**
     * Register a class / callback that should be used to create connected accounts.
     */
    public static function createConnectedAccountsUsing(string $class): void
    {
        app()->singleton(CreatesConnectedAccounts::class, $class);
    }

    /**
     * Register a class / callback that should be used to update connected accounts.
     */
    public static function updateConnectedAccountsUsing(string $class): void
    {
        app()->singleton(UpdatesConnectedAccounts::class, $class);
    }

    /**
     * Register a class / callback that should be used to set user passwords.
     */
    public static function setUserPasswordsUsing(callable | string $callback): void
    {
        app()->singleton(SetsUserPasswords::class, $callback);
    }

    /**
     * Register a class / callback that should be used to set user passwords.
     */
    public static function handlesInvalidStateUsing(callable | string $callback): void
    {
        app()->singleton(HandlesInvalidState::class, $callback);
    }

    /**
     * Register a class / callback that should be used for generating provider redirects.
     */
    public static function generatesProvidersRedirectsUsing(callable | string $callback): void
    {
        app()->singleton(GeneratesProviderRedirect::class, $callback);
    }
}
