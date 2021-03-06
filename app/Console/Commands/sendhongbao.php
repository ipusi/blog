<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\SendHongBaoMail;
use Illuminate\Support\Facades\Mail;
use App\Spread;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\Queue;
use Illuminate\Support\Facades\Log;

class sendhongbao extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sendhongbao {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '发送支付宝红包码';

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
        //
        $email = $this->argument('email');    //查询关键词
        if ($email) {
            Mail::to($email)->send(new SendHongBaoMail());
        } else {
            $emails = DB::select('select name,email from spreads where category="QQ" order by count asc,id asc limit 0,10');
            foreach ($emails as $key => $value) {
                // sleep(10);
                print $value->name."\n";
                try {
                    Mail::to($value->email)->queue(new SendHongBaoMail());
                    DB::update('update spreads set count = count+1 where email = ?', [$value->email]);
                } catch (\Exception $e) {
                    Log::error($value->name." ".$value->email."发送失败\n".$e);
                }
            }
        }
    }
}
