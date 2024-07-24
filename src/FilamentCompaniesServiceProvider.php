<?php

namespace Uchup07\FilamentCompanies;

//use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Filesystem\Filesystem;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Uchup07\FilamentCompanies\Commands\FilamentCompaniesCommand;
use Uchup07\FilamentCompanies\Http\Livewire\CompanyEmployeeManager;
use Uchup07\FilamentCompanies\Http\Livewire\ConnectedAccountsForm;
use Uchup07\FilamentCompanies\Http\Livewire\DeleteCompanyForm;
use Uchup07\FilamentCompanies\Http\Livewire\DeleteUserForm;
use Uchup07\FilamentCompanies\Http\Livewire\LogoutOtherBrowserSessionsForm;
use Uchup07\FilamentCompanies\Http\Livewire\SetPasswordForm;
use Uchup07\FilamentCompanies\Http\Livewire\UpdateCompanyNameForm;
use Uchup07\FilamentCompanies\Http\Livewire\UpdatePasswordForm;
use Uchup07\FilamentCompanies\Http\Livewire\UpdateProfileInformationForm;
use Uchup07\FilamentCompanies\Testing\TestsFilamentCompanies;

class FilamentCompaniesServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-companies';

    public static string $viewNamespace = 'filament-companies';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name(static::$name)
            ->hasCommands($this->getCommands())
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->askToStarRepoOnGitHub('uchup07/filament-companies');
            });

        $configFileName = $package->shortName();

        if (file_exists($package->basePath("/../config/{$configFileName}.php"))) {
            $package->hasConfigFile();
        }

        if (file_exists($package->basePath('/../database/migrations'))) {
            $package->hasMigrations($this->getMigrations());
        }

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    public function packageRegistered(): void {}

    public function packageBooted(): void
    {
        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        FilamentAsset::registerScriptData(
            $this->getScriptData(),
            $this->getAssetPackageName()
        );

        $this->configureComponents();

        // Icon Registration
        FilamentIcon::register($this->getIcons());

        // Handle Stubs
        if (app()->runningInConsole()) {
            foreach (app(Filesystem::class)->files(__DIR__ . '/../stubs/') as $file) {
                $this->publishes([
                    $file->getRealPath() => base_path("stubs/filament-companies/{$file->getFilename()}"),
                ], 'filament-companies-stubs');
            }
        }

        // Testing
        Testable::mixin(new TestsFilamentCompanies());
    }

    protected function getAssetPackageName(): ?string
    {
        return 'uchup07/filament-companies';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            // AlpineComponent::make('filament-companies', __DIR__ . '/../resources/dist/components/filament-companies.js'),
            Css::make('filament-companies-styles', __DIR__ . '/../resources/dist/filament-companies.css'),
            Js::make('filament-companies-scripts', __DIR__ . '/../resources/dist/filament-companies.js'),
        ];
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            FilamentCompaniesCommand::class,
        ];
    }

    /**
     * @return array<string>
     */
    protected function getIcons(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getRoutes(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getScriptData(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getMigrations(): array
    {
        return [
            'create_companies_table',
            'create_company_user_table',
            'create_company_invitations_table',
        ];
    }

    protected function configureComponents(): void
    {
        $featureComponentMap = [
            'update-profile-information-form' => [FilamentCompanies::canUpdateProfileInformation(), UpdateProfileInformationForm::class],
            'update-password-form' => [FilamentCompanies::canUpdatePasswords(), UpdatePasswordForm::class],
            'delete-user-form' => [FilamentCompanies::hasAccountDeletionFeatures(), DeleteUserForm::class],
            'logout-other-browser-sessions-form' => [FilamentCompanies::canManageBrowserSessions(), LogoutOtherBrowserSessionsForm::class],
            'update-company-name-form' => [FilamentCompanies::hasCompanyFeatures(), UpdateCompanyNameForm::class],
            'company-employee-manager' => [FilamentCompanies::hasCompanyFeatures(), CompanyEmployeeManager::class],
            'delete-company-form' => [FilamentCompanies::hasCompanyFeatures(), DeleteCompanyForm::class],
            'set-password-form' => [FilamentCompanies::canSetPasswords(), SetPasswordForm::class],
            'connected-accounts-form' => [FilamentCompanies::canManageConnectedAccounts(), ConnectedAccountsForm::class],
        ];

        foreach ($featureComponentMap as $alias => [$enabled, $component]) {
            if ($enabled) {
                Livewire::component($alias, $component);
            }
        }
    }
}
