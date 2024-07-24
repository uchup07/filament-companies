<x-filament-panels::page>
    @livewire(\Uchup07\FilamentCompanies\Http\Livewire\UpdateCompanyNameForm::class, compact('company'))

    @livewire(\Uchup07\FilamentCompanies\Http\Livewire\CompanyEmployeeManager::class, compact('company'))

    @if (!$company->personal_company && Gate::check('delete', $company))
        <x-filament-companies::section-border />
        @livewire(\Uchup07\FilamentCompanies\Http\Livewire\DeleteCompanyForm::class, compact('company'))
    @endif
</x-filament-panels::page>
