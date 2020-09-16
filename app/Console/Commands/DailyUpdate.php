<?php

namespace App\Console\Commands;

use App\Http\Controllers\OptInNotificationController;
use App\Subscriber;
use Illuminate\Console\Command;

class DailyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hour:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily message to all the active users';

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
     * @return mixed
     */
    public function handle()
    {

        $opt = new OptInNotificationController();
        $opt->sendMt();
//        $schedule->call('App\Http\Controllers\OptInNotificationController@sendMT');

        $this->info('Hourly Update has been send successfully');
        $this->info('Hourly Update has been send successfully');
        $this->info('Hourly Update has been send successfully');
    }
}
