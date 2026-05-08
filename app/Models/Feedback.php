<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback'; // keep this if your table is named 'feedback'

    protected $fillable = [
        'name',
        'email',
        'rating',
        'message'
    ];
}