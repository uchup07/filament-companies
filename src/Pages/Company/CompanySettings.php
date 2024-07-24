<?php

namespace Uchup07\FilamentCompanies\Pages\Company;

use Filament\Facades\Filament;
use Filament\Pages\Tenancy\EditTenantProfile as BaseEditTenantProfile;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;

use function Filament\authorize;

class CompanySettings extends BaseEditTenantProfile
{
    protected static string $view = 'filament-companies::filament.pages.companies.company-settings';

    public static function getLabel(): string
    {
        return __('filament-companies::companies.pages.titles.company_settings');
    }

    public static function canView(Model $tenant): bool
    {
        try {
            return authorize('view', $tenant)->allowed();
        } catch (AuthorizationException $exception) {
            return $exception->toResponse()->allowed();
        }
    }

    protected function getViewData(): array
    {
        return [
            'company' => Filament::getTenant(),
        ];
    }
}
