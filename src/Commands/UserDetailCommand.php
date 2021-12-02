<?php

namespace Danielebarbaro\UserDetail\Commands;

use Illuminate\Console\Command;

class UserDetailCommand extends Command
{
    public $signature = 'laravel-user-details';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
