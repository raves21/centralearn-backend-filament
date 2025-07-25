<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasUuids;

    protected $fillable = ['user_id', 'job_title'];

    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
