<?php

namespace App\Rules;

use App\Helpers\JobPostingHelper;
use App\Models\JobApplication;
use App\Models\JobPosting;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IsPostActive implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if(JobPostingHelper::isExists($value)===false)
        {
            $fail("Job posting Id of this id has not been found.");
            return;
        }
        if (!JobPostingHelper::isActive($value))
        {
            $fail("Applications for this ad have been closed.");
            return;
        }
        if (JobPostingHelper::doesHaveApp($value,request()->user()->id)===true)
        {
            $fail("You have already applied for this job.");
        }


    }
}
