<?php

namespace Database\Seeders;

use App\Models\Airline;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirlineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $httpClient = new \GuzzleHttp\Client();
        $request = $httpClient->get("https://api.instantwebtools.net/v1/airlines");
        $airlines = json_decode($request->getBody()->getContents(),true);

        foreach($airlines as $airline) {
            if(count($airline)==8) {
                Airline::create(array(
                    'name' => $airline['name'],
                    'country' => $airline['country'],
                    'logo' => $airline['logo'],
                    'slogan' => $airline['slogan'],
                    'headquarters' => $airline['head_quaters'],
                    'website' => $airline['website'],
                    'established' => $airline['established']
                ));
            }

        }

    }
}
