<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ksssystem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'objective',
        'suggest',
        'suggest_type',
        'current',
        'improve',
        'results',
        'cost',
        'date',
        'discuss_res',
        'past_res',
        'unit_res',
        'board_res',
        'expansion',
    ];
}
