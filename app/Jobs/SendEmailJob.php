<?php

namespace App\Jobs;

use App\Mail\ApplicationSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
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
        if($this->data['operation']==="appCreate")
        {
            Mail::to("info@macellan.net")->send(new ApplicationSent($this->data));
            $this->data['subject']="İlanına yeni bir başvuru var.";
            $this->data['operation']="ownerJobCreate";
            Mail::to("info@macellan.net")->send(new ApplicationSent($this->data));
            return;
        }
        Mail::to("info@macellan.net")->send(new ApplicationSent($this->data));
    }
}
