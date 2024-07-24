<?php

namespace Uchup07\FilamentCompanies\Commands;

use Illuminate\Console\Command;

class FilamentCompaniesCommand extends Command
{
    public $signature = 'filament-companies';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
