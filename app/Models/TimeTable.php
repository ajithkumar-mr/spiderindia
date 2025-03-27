<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    use HasFactory;

    protected $table = 'time_tables';
    
    protected $guarded = [];

    protected $fillable = [
        'clas',
        'no_of_days',
        'no_of_period',
        'clas_time',
        'duration_class',
        'no_of_breaks',
        'period_break1',
        'duration_break1',
        'period_break2',
        'duration_break2',
        'period_break3',
        'duration_break3',
    ];

    // protected $fillable = [
    //     'clas', 
    //     'no_of_days',
    //     'no_of_period',
    //     'time',
    //     'duration_class',
    //     'no_of_breaks',
    //     'period_break1',
    //     'duration_break1',
    //     'period_break2',
    //     'duration_break2',
    //     'period_break3',
    //     'duration_break3',
    // ];

}

