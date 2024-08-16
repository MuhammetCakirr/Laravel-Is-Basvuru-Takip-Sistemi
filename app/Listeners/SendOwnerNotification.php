<?php

namespace App\Listeners;

use App\Events\OwnerReminderMail;
use App\Jobs\OwnerReminderMailJob;
use App\Models\JobPosting;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SendOwnerNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OwnerReminderMail $event): void
    {
        $postOwners = $this->getUnresponsivePostOwners();
        Log::info("Tekrarlandı.");
        dispatch(new OwnerReminderMailJob($postOwners));
    }

    public function getUnresponsivePostOwners(): array
    {
        $applications = DB::table('job_application')
            ->join('job_posting', 'job_application.job_posting_id', '=', 'job_posting.id')
            ->where('job_application.first_view', 0)
            ->where('job_posting.post_status_id', 1)
            ->select('job_application.job_posting_id', DB::raw('count(*) as application_count'))
            ->groupBy('job_application.job_posting_id')
            ->get();

        $unresponsivePostOwners = [];

        foreach ($applications as $application) {
            $jobPosting = JobPosting::query()->find($application->job_posting_id);
            $postOwner = $jobPosting->user->name;

            if (isset($unresponsivePostOwners[$postOwner])) {
                $unresponsivePostOwners[$postOwner] += $application->application_count;
            } else {
                $unresponsivePostOwners[$postOwner] = $application->application_count;
            }
        }

        return $unresponsivePostOwners;
    }
}
