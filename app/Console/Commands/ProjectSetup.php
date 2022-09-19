<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProjectSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:project {--db_name=} {--db_username=} {--db_password=}';

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
        $database = $this->option('db_name');
        $username = $this->option('db_username');
        $password = $this->option('db_password');

        //Updating environment variables for database connection
        if($database){
            $env_path = base_path('.env.example');
            $path = base_path('.env');
            echo shell_exec('cp -r '.$env_path.' '.$path);

            if (file_exists($path)) {
                $env_content = str_replace('DB_DATABASE=laravel', 'DB_DATABASE='.$database, str_replace('DB_USERNAME=root', 'DB_USERNAME='.$username, str_replace('DB_PASSWORD=', 'DB_PASSWORD='.$password, file_get_contents($path))));
                file_put_contents($path, $env_content);
            }
        }
        
        return 0;
    }
}
