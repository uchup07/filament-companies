<?php

namespace Uchup07\FilamentCompanies\Http\Livewire;

use Filament\Notifications\Notification;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Uchup07\FilamentCompanies\Actions\ValidateCompanyDeletion;
use Uchup07\FilamentCompanies\Contracts\DeletesCompanies;
use Uchup07\FilamentCompanies\FilamentCompanies;
use Uchup07\FilamentCompanies\RedirectsActions;

class DeleteCompanyForm extends Component
{
    use RedirectsActions;

    /**
     * The company instance.
     */
    public mixed $company;

    /**
     * Mount the component.
     */
    public function mount(mixed $company): void
    {
        $this->company = $company;
    }

    /**
     * Delete the company.
     *
     * @throws AuthorizationException
     */
    public function deleteCompany(ValidateCompanyDeletion $validator, DeletesCompanies $deleter): Response | Redirector | RedirectResponse
    {
        $validator->validate(Auth::user(), $this->company);

        $deleter->delete($this->company);

        if (FilamentCompanies::hasNotificationsFeature()) {
            if (method_exists($deleter, 'companyDeleted')) {
                $deleter->companyDeleted($this->company);
            } else {
                $this->companyDeleted($this->company);
            }
        }

        $this->company = null;

        return $this->redirectPath($deleter);
    }

    /**
     * Cancel the company deletion.
     */
    public function cancelCompanyDeletion(): void
    {
        $this->dispatch('close-modal', id: 'confirmingCompanyDeletion');
    }

    /**
     * Render the component.
     */
    public function render(): View
    {
        return view('filament-companies::companies.delete-company-form');
    }

    public function companyDeleted($company): void
    {
        $name = $company->name;

        Notification::make()
            ->title(__('filament-companies::companies.notifications.company_deleted.title'))
            ->success()
            ->body(Str::inlineMarkdown(__('filament-companies::companies.notifications.company_deleted.body', compact('name'))))
            ->send();
    }
}
