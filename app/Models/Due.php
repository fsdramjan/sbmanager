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

    public function getButtonColorAttribute() {

        if ($this->dueDetails->first()->due_type === 'Deposit') {
            return 'success';
        } elseif ($this->dueDetails->first()->due_type === 'Due') {
            return 'danger';
        }

    }
}
