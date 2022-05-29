<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    use HasFactory;

    protected $guarded = [];

    public function consumer() {
        return $this->belongsTo(Consumer::class, 'consumer_id', 'id');
    }

    public function orderProduct() {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }

    public function getButtonColorAttribute() {

        if ($this->payment_method === 'Cash') {
            return 'primary';
        } elseif ($this->payment_method === 'Digital Payment') {
            return 'success';
        } elseif ($this->payment_method === 'Due') {
            return 'danger';
        } elseif ($this->payment_method === 'Personal Payment') {
            return 'info';
        }

    }

}
