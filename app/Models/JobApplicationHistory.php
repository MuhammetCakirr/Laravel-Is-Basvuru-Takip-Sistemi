<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplicationHistory extends Model
{
    use HasFactory;
    protected $table = 'job_application_history';
    protected $fillable = ['user_id', 'job_posting_id','job_application_id', 'action', 'detail'];
}
