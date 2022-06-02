<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DueDetail extends Model {
    use HasFactory;

    protected $guarded = [];

    public function due() {
        return $this->belongsTo(Due::class);
    }

    public function getBCAttribute() {

        if ($this->due_type === 'Deposit') {
            return 'success';
        } elseif ($this->due_type === 'Due') {
            return 'danger';
        }

    }
}
