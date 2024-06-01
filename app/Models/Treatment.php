<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'image', 'cost', 'specialty_id'
    ];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }
}




