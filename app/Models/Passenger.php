<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['airline_id'] ?? false, fn($query,$airline_id) =>
        $query
            ->where('airline_id','=', $airline_id )
        );

        $query->when($filters['search'] ?? false, fn($query,$search) =>
        $query
            ->where('name','like', '%' . $search . '%')
            ->orWhere()
        );
    }

    public function airline()
    {
        return $this->belongsTo(Airline::class);
    }

}
