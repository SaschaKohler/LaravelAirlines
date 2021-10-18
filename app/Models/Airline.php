<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    use HasFactory;

    protected $table = 'airline_table';


    protected $fillable = [
        'name',
        'country',
        'logo',
        'slogan',
        'headquarters',
        'website',
        'established',
    ];

}
