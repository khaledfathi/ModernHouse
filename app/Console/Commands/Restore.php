<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Restore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:restore';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import database';

    /**
     * Execute the console command.
     */
    public function handle():bool
    {   
        $output=''; 
        $result_code=0; 
        exec('mysql -p'.getenv('DB_PASSWORD').' -u '.getenv('DB_USERNAME').' '.getenv('DB_DATABASE').' < '.public_path().'/backup.sql', $output ,$result_code);
        return $result_code; 
    }
}
