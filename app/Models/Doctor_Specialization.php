<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor_Specialization extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialization_id',
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class);
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function range()
    {
        return $this -> hasMany(Working_Range::class , 'doctor_id' , 'user_id');
    }

}
