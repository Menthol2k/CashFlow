<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encashment extends Model
{
    protected $guarded = ['id'];
    protected $with = ['team'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
