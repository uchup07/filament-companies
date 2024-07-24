<?php

namespace Uchup07\FilamentCompanies\Concerns\Base;

use Uchup07\FilamentCompanies\Contracts\AddsCompanyEmployees;
use Uchup07\FilamentCompanies\Contracts\CreatesCompanies;
use Uchup07\FilamentCompanies\Contracts\CreatesNewUsers;
use Uchup07\FilamentCompanies\Contracts\DeletesCompanies;
use Uchup07\FilamentCompanies\Contracts\DeletesUsers;
use Uchup07\FilamentCompanies\Contracts\InvitesCompanyEmployees;
use Uchup07\FilamentCompanies\Contracts\RemovesCompanyEmployees;
use Uchup07\FilamentCompanies\Contracts\UpdatesCompanyNames;
use Uchup07\FilamentCompanies\Contracts\UpdatesUserPasswords;
use Uchup07\FilamentCompanies\Contracts\UpdatesUserProfileInformation;

trait HasBaseActionBindings
{
    /**
     * Register a class / callback that should be used to create new users.
     */
    public static function createUsersUsing(string $class): void
    {
        app()->singleton(CreatesNewUsers::class, $class);
    }

    /**
     * Register a class / callback that should be used to update user profile information.
     */
    public static function updateUserProfileInformationUsing(string $class): void
    {
        app()->singleton(UpdatesUserProfileInformation::class, $class);
    }

    /**
     * Register a class / callback that should be used to update user passwords.
     */
    public static function updateUserPasswordsUsing(string $class): void
    {
        app()->singleton(UpdatesUserPasswords::class, $class);
    }

    /**
     * Register a class / callback that should be used to create companies.
     */
    public static function createCompaniesUsing(string $class): void
    {
        app()->singleton(CreatesCompanies::class, $class);
    }

    /**
     * Register a class / callback that should be used to update company names.
     */
    public static function updateCompanyNamesUsing(string $class): void
    {
        app()->singleton(UpdatesCompanyNames::class, $class);
    }

    /**
     * Register a class / callback that should be used to add company employees.
     */
    public static function addCompanyEmployeesUsing(string $class): void
    {
        app()->singleton(AddsCompanyEmployees::class, $class);
    }

    /**
     * Register a class / callback that should be used to add company employees.
     */
    public static function inviteCompanyEmployeesUsing(string $class): void
    {
        app()->singleton(InvitesCompanyEmployees::class, $class);
    }

    /**
     * Register a class / callback that should be used to remove company employees.
     */
    public static function removeCompanyEmployeesUsing(string $class): void
    {
        app()->singleton(RemovesCompanyEmployees::class, $class);
    }

    /**
     * Register a class / callback that should be used to delete companies.
     */
    public static function deleteCompaniesUsing(string $class): void
    {
        app()->singleton(DeletesCompanies::class, $class);
    }

    /**
     * Register a class / callback that should be used to delete users.
     */
    public static function deleteUsersUsing(string $class): void
    {
        app()->singleton(DeletesUsers::class, $class);
    }
}
