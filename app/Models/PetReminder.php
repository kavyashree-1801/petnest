<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetReminder extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',
        'category',
        'pet_name',
        'reminder_type',
        'reminder_date',
        'notes',
        'status'

    ];
}