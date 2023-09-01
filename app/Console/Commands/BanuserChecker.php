<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class BanuserChecker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:banUsers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $currentTimestamp = Carbon::now()->timestamp;
        $users=User::where('blocked',1)->WhereNotNull('block_release_date')->where('block_release_date', '<=', $currentTimestamp)->limit(50)->get();
        if($users && count($users) > 0){
            foreach ($users as $key => $u) {
                $u->blocked=0;
                $u->block_release_date=null;
                $u->save();
            }
        }
        return 0;
    }
}
