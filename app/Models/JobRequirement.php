<?php

namespace App\Models;

use App\Traits\ResponseApi;
use App\Traits\TrackModelChanges;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobRequirement extends Model
{
    use HasFactory,SoftDeletes,TrackModelChanges,ResponseApi;

    protected $table = 'job_requirement';

    protected $fillable = ['postId', 'require'];

    public function post()
    {
        return $this->belongsTo(JobPosting::class, 'postId');
    }
    public function getId():int
    {
        return $this->attributes['id'];
    }
}
