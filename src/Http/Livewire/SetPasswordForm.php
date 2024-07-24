<?php

namespace Uchup07\FilamentCompanies\Http\Livewire;

use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Uchup07\FilamentCompanies\Contracts\SetsUserPasswords;
use Uchup07\FilamentCompanies\FilamentCompanies;

class SetPasswordForm extends Component
{
    /**
     * The component's state.
     *
     * @var array<string, mixed>
     */
    public $state = [
        'password' => '',
        'password_confirmation' => '',
    ];

    /**
     * Update the user's password.
     */
    public function setPassword(SetsUserPasswords $setter): void
    {
        $this->resetErrorBag();

        $setter->set(Auth::user(), $this->state);

        $this->state = [
            'password' => '',
            'password_confirmation' => '',
        ];

        if (FilamentCompanies::hasNotificationsFeature()) {
            if (method_exists($setter, 'passwordSet')) {
                $setter->passwordSet(Auth::user(), $this->state);
            } else {
                $this->passwordSet();
            }
        }
    }

    /**
     * Get the current user of the application.
     */
    public function getUserProperty(): ?Authenticatable
    {
        return Auth::user();
    }

    /**
     * Render the component.
     */
    public function render(): View
    {
        return view('filament-companies::profile.set-password-form');
    }

    public function passwordSet(): void
    {
        Notification::make()
            ->title(__('filament-companies::companies.notifications.password_set.title'))
            ->success()
            ->color(Color::Green)
            ->body(__('filament-companies::companies.notifications.password_set.body'))
            ->duration(3000)
            ->send();
    }
}
