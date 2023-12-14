<?php

namespace Kainiklas\FilamentScout\Commands;

use Illuminate\Console\Command;

class FilamentScoutCommand extends Command
{
    public $signature = 'filament-scout';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
