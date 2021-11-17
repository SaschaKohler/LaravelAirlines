<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AirlineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $airlines = Airline::query()
            ->filter(request(['search']))
            ->paginate(request('per_page'));

        return $airlines;

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Support\MessageBag
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'country' => 'required',
            'logo' => 'required|url',
            'slogan' => 'required',
            'headquarters' => 'required',
            'website' => 'required',
            'established' => 'required',
        ]);

        if($validator->fails()){
            return $validator->errors();
        }

        $validated = $validator->validated();
        return Airline::create($validated);


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //  $airline = Airline::find($id);
        return Airline::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd('Not implemented in classic api');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $airline = Airline::find($id);
        $airline->update($request->all());
        return $airline;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $airline = Airline::find($id);
        $airline->delete();
    }
}
