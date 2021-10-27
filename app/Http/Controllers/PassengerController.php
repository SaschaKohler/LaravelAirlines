<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class PassengerController extends Controller
{

    /*
     * repeat code outsourced
     */

    protected function getAPIData($url)
    {
        $httpClient = new \GuzzleHttp\Client();
        $request = $httpClient->get($url);
        $data = json_decode($request->getBody()->getContents(), true);
        return $data;
    }

    /*
     * $airline_id  goes with the GET request (api.php)
     *
     * $request for testing classic ?page=1  as $request->input();
     */

    public function getPassengersPerAirlinePaginated(Request $request, $airline_id)
    {

        //$data = $this->getAPIData("https://api.instantwebtools.net/v1/passenger"); // getting array with number totalPassengers
        $passengers = $this->getAPIData("https://api.instantwebtools.net/v1/passenger?page=0&size=50");
         //   . $data['totalPassengers']);  // getting the whole bunch of Passengers with airlines nested

        $passengerCollection = collect($passengers['data']);    // for later filtering method

        $arrayFiltered = $passengerCollection->filter(function ($value) use ($airline_id) {
            return $value['airline'][0]['id'] == $airline_id;
        });

        if (!empty($request->input('page'))) {  // checking for page request
            $page = $request->input('page');   // if true set pageIndex - 1  array starts with 0 ;)
        } else {
            $page = 1;   // start at page 1
        }

        $perPage = 50;    // amount of items per page is hard coded else we have to calculate ( perPage = totalPassengers / pageCount)

        $paginate = new LengthAwarePaginator(         // Laravel Documentation "LengthAwarePaginator"
            $arrayFiltered->forPage($page, $perPage),
            $arrayFiltered->count(),
            $perPage,
            $page,
        );

        return $paginate->items();   // return items;

    }


}
