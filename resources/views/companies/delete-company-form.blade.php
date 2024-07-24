@php
    $modals = \Uchup07\FilamentCompanies\FilamentCompanies::getModals();
@endphp

<x-filament-companies::grid-section md="2">
    <x-slot name="title">
        {{ __('filament-companies::companies.action_section_titles.delete_company') }}
    </x-slot>

    <x-slot name="description">
        {{ __('filament-companies::companies.action_section_descriptions.delete_company') }}
    </x-slot>

    <x-filament::section>
        <div class="grid gap-y-6">
            <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
                {{ __('filament-companies::companies.subheadings.companies.delete_company') }}
            </div>

            <!-- Delete Company Confirmation Modal -->
            <x-filament::modal id="confirmingCompanyDeletion" icon="heroicon-o-exclamation-triangle" icon-color="danger" alignment="{{ $modals['alignment'] }}" footer-actions-alignment="{{ $modals['formActionsAlignment'] }}" width="{{ $modals['width'] }}">
                <x-slot name="trigger">
                    <div class="text-left">
                        <x-filament::button color="danger">
                            {{ __('filament-companies::companies.buttons.delete_company') }}
                        </x-filament::button>
                    </div>
                </x-slot>

                <x-slot name="heading">
                    {{ __('filament-companies::companies.modal_titles.delete_company') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('filament-companies::companies.modal_descriptions.delete_company') }}
                </x-slot>

                <x-slot name="footerActions">
                    @if($modals['cancelButtonAction'])
                        <x-filament::button color="gray" wire:click="cancelCompanyDeletion">
                            {{ __('filament-companies::companies.buttons.cancel') }}
                        </x-filament::button>
                    @endif

                    <x-filament::button color="danger" wire:click="deleteCompany">
                        {{ __('filament-companies::companies.buttons.delete_company') }}
                    </x-filament::button>
                </x-slot>
            </x-filament::modal>
        </div>
    </x-filament::section>
</x-filament-companies::grid-section>
