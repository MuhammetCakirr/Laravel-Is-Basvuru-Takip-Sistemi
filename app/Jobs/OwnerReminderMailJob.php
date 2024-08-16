<?php

namespace App\Jobs;

use App\Mail\ApplicationSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OwnerReminderMailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public array $data;
    public function __construct(array $data)
    {
        $this->data=$data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->data as $key=>$value){
           Mail::to("info@macellan.net")->send(new ApplicationSent(["operation"=>"ownerReminder","subject"=>"Başvurularına dönüş yapmadığın kullanıcılar var.","userName"=>$key,"appCount"=>$value]));
        }
    }
}
