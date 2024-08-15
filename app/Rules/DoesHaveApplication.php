<?php

namespace App\Rules;

use App\Helpers\JobPostingHelper;
use App\Models\JobApplication;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

    class DoesHaveApplication implements ValidationRule
    {
        /**
         * Run the validation rule.
         *
         * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
         */
        public function validate(string $attribute, mixed $value, Closure $fail): void
        {
            $application = JobApplication::query()->where('id', $value)->where('user_id',request()->user()->id)->first();

            if($application){
                if(JobPostingHelper::isExists($application->job_posting_id)===false)
                {
                    $fail("Job posting Id of this id has not been found.");
                    return;
                }
                if (!JobPostingHelper::isActive($application->job_posting_id))
                {
                    $fail("Applications for this ad have been closed.");
                    return;
                }
                if (JobPostingHelper::doesHaveApp($application->job_posting_id,request()->user()->id)===false)
                {
                    $fail("You are not authorized to edit this application or it does not exist.");
                }
            }
        }
    }
