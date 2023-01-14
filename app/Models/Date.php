<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'doctor_id',
        'date',
        'confirmed',
    ];

    public function dates()
    {
        return $this -> hasMany(User::class , 'id' , 'doctor_id');
    }

}
