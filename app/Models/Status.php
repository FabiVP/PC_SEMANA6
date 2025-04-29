<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Status extends Model
{
    use HasFactory;

    protected $guarded = [];

    /* usercanseeotheruser*/
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
