<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'calendly_event_id',
        'session_time',
        'amount',
        'payment_status',
        'pesapal_transaction_id'
    ];
}
