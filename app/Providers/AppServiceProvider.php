<?php

namespace App\Providers;

use App\Events\OwnerReminderMail;
use App\Listeners\SendOwnerNotification;
use App\Models\JobApplication;
use App\Models\JobPosting;
use App\Models\JobRequirement;
use App\Models\Skill;
use App\Models\User;
use App\Observers\JobApplicationObserver;
use App\Observers\JobRequirementObserver;
use App\Observers\PostObserver;
use App\Observers\SkillObserver;
use App\Observers\UserObserver;
use App\Policies\JobApplicationPolicy;
use App\Policies\JobRequirementPolicy;
use App\Policies\PostPolicy;
use App\Policies\SkillPolicy;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        JobPosting::observe(PostObserver::class);
        Skill::observe(SkillObserver::class);
        JobRequirement::observe(JobRequirementObserver::class);
        JobApplication::observe(JobApplicationObserver::class);

        Gate::policy(Skill::class, SkillPolicy::class);
        Gate::policy(JobPosting::class, PostPolicy::class);
        Gate::policy(JobRequirement::class, JobRequirementPolicy::class);
        Gate::policy(JobApplication::class,JobApplicationPolicy::class);

        Event::listen(
            OwnerReminderMail::class,
            SendOwnerNotification::class,
        );

    }
}
