<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    public function patient()
    {
        return $this->belongsTo('\App\Models\Patient');
    }

    public function staff()
    {
        return $this->belongsTo('\App\Models\Staff');
    }



}
