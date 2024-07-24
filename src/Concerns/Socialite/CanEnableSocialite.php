<?php

namespace Uchup07\FilamentCompanies\Concerns\Socialite;

use Closure;

trait CanEnableSocialite
{
    public static bool $hasSocialiteFeatures = false;

    public function socialite(bool | Closure | null $condition = true, ?array $providers = null, ?array $features = null): static
    {
        $this->enableSocialite($condition);
        $this->setProviders($providers);
        $this->setFeatures($features);
    }

    public function enableSocialite(bool | Closure | null $condition = true): static
    {
        $isEnabled = $condition instanceof Closure ? $condition() : $condition;
        static::$hasSocialiteFeatures = $isEnabled;

        if(!$isEnabled) {
            static::disableAllSocialiteFeatures();
        }

        return $this;
    }

    private static function disableAllSocialiteFeatures(): void
    {
        static::$hasSocialiteFeatures = false;
        static::$canSetPasswords = false;
        static::$canManageConnectedAccounts = false;
    }

    /**
     * Determine if the application has support for socialite.
     */
    public static function hasSocialiteFeatures(): bool
    {
        return static::$hasSocialiteFeatures;
    }


}
