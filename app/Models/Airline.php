<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    use HasFactory;

    protected $table = 'airline_table';

    public $timestamps=true;

    protected $fillable = [
        'name',
        'country',
        'logo',
        'slogan',
        'headquarters',
        'website',
        'established',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:00',
        'updated_at' => 'datetime:Y-m-d H:00',
    ];



}
