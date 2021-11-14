<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    use HasFactory;

    protected $table = 'airline_table';

    protected $guarded = ['id'];

//    protected $fillable = [
//        'name',
//        'country',
//        'logo',
//        'slogan',
//        'headquarters',
//        'website',
//        'established',
//    ];




    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn($query,$search) =>
            $query
            ->where('name','like','%' . $search . '%')

        );
    }

    public function passenger() {
        $this->hasMany(Passenger::class);
    }

}
