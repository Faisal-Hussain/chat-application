<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckVipUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:vip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check vip users and change to custom.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }



    public function handle()
    {
        $data = User::query()->whereHas('roles', function ($q) {
            $q->where('name', '=', 'vip');
        })->whereHas('periodVipUser', function ($q) {
            $q->whereDate('end_date', '<', Carbon::today());
        });
        $count =  $data->count();
        if($count > 0) {
            foreach ($data->get() as $user) {
                $user->syncRoles(['basic']);
            }
            Log::info('check vip users ' . $count);
        }
    }
}
