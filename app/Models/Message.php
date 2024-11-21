<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = ['id'];
    protected $with = ['team'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
