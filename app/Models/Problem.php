<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function appointments()
    {
        return $this->hasMany('\App\Models\Apointment');
    }
}
