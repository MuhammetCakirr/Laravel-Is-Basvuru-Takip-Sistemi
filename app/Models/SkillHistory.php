<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillHistory extends Model
{
    use HasFactory;

    protected $table = 'skill_history';

    protected $fillable = ['user_id', 'action', 'detail', 'skill_id'];
}
