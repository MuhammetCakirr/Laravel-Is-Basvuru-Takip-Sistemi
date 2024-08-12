<?php

namespace App\Models;

use App\Traits\ResponseApi;
use App\Traits\TrackModelChanges;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**,
 * @property int $id
 * @property int $level
 * @property string $name
 * @property int $user_id
 */
class Skill extends Model
{
    use HasFactory,ResponseApi,SoftDeletes,TrackModelChanges;

    protected $table = 'skills';

    protected $fillable = ['name', 'user_id', 'level'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUserId()
    {
        return $this->attributes['user_id'];
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }
}
