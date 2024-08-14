<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRequirementHistory extends Model
{
    use HasFactory;

    protected $table = 'job_requirement_history';

    protected $fillable = ['user_id', 'post_id', 'action', 'detail','requirement_id'];
}
