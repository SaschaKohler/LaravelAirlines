<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Http\Request;

class AirlineController extends Controller
{
    public function index()
    {
        return Airline::all();
    }

    public function show($id)
    {
        return Airline::find($id);
    }

    public function store(Request $request)
    {
        return Airline::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $airline = Airline::find($id);
        $airline->update($request->all());

        return $airline;
    }

    public function delete(Request $request, $id)
    {
        $airline = Airline::findOrFail($id);
        $airline->delete();

        return 204;
    }

}
