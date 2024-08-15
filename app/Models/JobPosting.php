<?php

namespace App\Models;

use App\Traits\ResponseApi;
use App\Traits\TrackModelChanges;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPosting extends Model
{
    use HasFactory,ResponseApi,SoftDeletes,TrackModelChanges;

    protected $table = 'job_posting';

    protected $fillable = ['user_id', 'post_title', 'post_description', 'job_title', 'location', 'type_of_work', 'price','post_status_id'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function requirements(): HasMany
    {
        return $this->hasMany(JobRequirement::class,'postId');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class,'job_posting_id','id');
    }
    public function status(): HasOne
    {
        return $this->hasOne(PostStatus::class,'id','post_status_id');
    }

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function getUserId()
    {
        return $this->attributes['user_id'];
    }
}
