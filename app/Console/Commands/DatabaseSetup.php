<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DatabaseSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To setup the project with one command';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //generating laravel encryption keys
        $this->call("key:generate");

        //migrating tables to database
        $this->call("migrate");

        //seeding dummy data
        $this->call("db:seed");

        //generating passport keys
        $this->call("passport:keys");

        return 0;
    }
}
