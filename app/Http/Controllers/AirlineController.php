<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use Illuminate\Http\Request;
use Validator;

class AirlineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Airline::all()->toJson(JSON_PRETTY_PRINT);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'country' => 'required',
            'logo' => 'required',
            'slogan' => 'required',
            'headquarters' => 'required',
            'website' => 'required',
            'established' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            return json_encode($messages->all());

        } else {
            $airline = new Airline();
            $airline->name = $request->input('name');
            $airline->country = $request->input('country');
            $airline->logo = $request->input('logo');
            $airline->slogan = $request->input('slogan');
            $airline->headquarters = $request->input('headquarters');
            $airline->website = $request->input('website');
            $airline->established = $request->input('established');

            $airline->save();

            return $airline;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $airline = Airline::find($id);
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
