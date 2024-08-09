<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JobPosting extends Model
{
    use HasFactory;
    protected $table="job_posting";
    protected  $fillable=['user_id','post_title','post_description','job_title','location','type_of_work','price'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function requirements(): HasMany
    {
        return $this->hasMany(JobRequirement::class);
    }
}
