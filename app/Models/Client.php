<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = ['id'];
    protected $with = ['team'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
