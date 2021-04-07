<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\user as Authenticatable;
use Illuminate\Support\Facades\Auth;

class Patient extends Authenticatable
{
    use HasFactory, Notifiable;


    public function appointments()
    {
        return $this->hasMany('\App\Models\Appointment');
    }
}
