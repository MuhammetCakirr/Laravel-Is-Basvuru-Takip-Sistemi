<?php

namespace App\Models;

use App\Traits\ResponseApi;
use App\Traits\TrackModelChanges;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobApplication extends Model
{
    use HasFactory,ResponseApi,TrackModelChanges,SoftDeletes;
    protected $table ="job_application";
    protected $fillable=["job_posting_id","user_id","status_id","cover_letter"];

    public function status(): HasOne
    {
        return $this->hasOne(Status::class,'id','status_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function post(): HasOne
    {
        return $this->hasOne(JobPosting::class,'id','job_posting_id');
    }
    public function getId():int
    {
        return $this->attributes['id'];
    }

}
