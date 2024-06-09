<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'review',
        'score',
    ];

    /**
     * Get the appointment that owns the review.
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
