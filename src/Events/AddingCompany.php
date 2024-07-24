<?php

namespace Uchup07\FilamentCompanies\Events;

use Illuminate\Foundation\Events\Dispatchable;

class AddingCompany
{
    use Dispatchable;

    public mixed $owner;

    public function __construct(mixed $owner)
    {
        $this->owner = $owner;
    }
}
