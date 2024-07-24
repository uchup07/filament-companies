<?php

namespace Uchup07\FilamentCompanies\Contracts;

use Symfony\Component\HttpFoundation\RedirectResponse;

interface GeneratesProviderRedirect
{
    /**
     * Generates the redirect for a given provider.
     */
    public function generate(string $provider): RedirectResponse;
}
