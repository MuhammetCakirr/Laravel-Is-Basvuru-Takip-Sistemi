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

    protected $fillable = ['user_id', 'post_title', 'post_description', 'job_title', 'location', 'type_of_work', 'price'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function requirements(): HasMany
    {
        return $this->hasMany(JobRequirement::class);
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
