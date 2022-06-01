<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Due extends Model {
    use HasFactory;

    protected $guarded = [];

    public function dueDetails() {
        return $this->hasMany(DueDetail::class);
    }
}
