<?php

namespace Database\Seeders;

use App\Models\Passenger;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PassengerTableSeeder extends Seeder
{


    protected function getAPIData($url)
    {
        $httpClient = new \GuzzleHttp\Client();
        $request = $httpClient->get($url);
        $data = json_decode($request->getBody(),true);
        return $data;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       // $data = $this->getAPIData("https://api.instantwebtools.net/v1/passenger"); // getting array with number totalPassengers
        $passengers = $this->getAPIData("https://api.instantwebtools.net/v1/passenger?page=0&size=10000");
            //. $data['totalPassengers']);  // getting the whole bunch of Passengers with airlines nested

        $passengerCollection = collect($passengers['data']);    // for later filtering method
        //$passengersUniqueByName = $passengerCollection->unique('airline');

        foreach ($passengerCollection as $passenger) {
            if (isset($passenger['_id'], $passenger['name'], $passenger['trips'],
                $passenger['airline'])) {

                Passenger::create(array(
                    '_id' => $passenger['_id'],
                    'name' => trim($passenger['name']),
                    'trips' => $passenger['trips'],
                    'airline_id' => $passenger['airline'][0]['id']

                ));
            }
        }
    }
}
