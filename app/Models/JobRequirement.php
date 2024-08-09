<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobRequirement extends Model
{
    use HasFactory;
    protected $table="job_requirement";
    protected  $fillable=['postId','require'];

    public function post(): BelongsTo
    {
        return $this->belongsTo(JobPosting::class);
    }
}
