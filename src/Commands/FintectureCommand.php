<?php

namespace Bnzo\Fintecture\Commands;

use Illuminate\Console\Command;

class FintectureCommand extends Command
{
    public $signature = 'laravel-fintecture';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
