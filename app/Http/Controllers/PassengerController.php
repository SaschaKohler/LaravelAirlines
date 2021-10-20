<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class PassengerController extends Controller
{

    /*
     * repetetiv code outsourced
     */

    protected function getAPIData($url){
        $httpClient = new \GuzzleHttp\Client();
        $request = $httpClient->get($url);
        $data = json_decode($request->getBody()->getContents(), true);
        return $data;
    }

    /*
     * getPage returns paginated PassengerList
     * 50 passenger per page
     *
     * if pageIndex >= totalPassengers / $perPage(50)  -> getPage returns empty array.
     *  -> Error message seems unnecessary
     */


    public function getPage(Request $request)
    {
        $data =  $this->getAPIData("https://api.instantwebtools.net/v1/passenger"); // getting array with number totalPassengers
        $passengers = $this->getAPIData("https://api.instantwebtools.net/v1/passenger?page=0&size="
            . $data['totalPassengers']);  // getting the whole bunch of Passengers with airlines nested

        if (!empty($request->input('page'))){  // checking for page request
            $page = $request->input('page');   // if true set pageIndex
        } else {
            $page = 1;   // start at page 1
        }

        $collection = collect($passengers['data']);  // collection for later stats or ordering
        $perPage = 50;    // amount of items per page is hard coded else we have to calculate ( perPage = totalPassengers / pageCount)

        $paginate = new LengthAwarePaginator(         // Laravel Documentation "LengthAwarePaginator"
            $collection->forPage($page, $perPage),
            $collection->count(),
            $perPage,
            $page,
        );

        return $paginate->items();   // return items;
    }

    /*
     * $airline_id  goes with the GET request (api.php)
     *
     * $request for testing classic ?page=1  as $request->input();
     */

    public function getPassengersPerAirline(Request $request, $airline_id){

        $data =  $this->getAPIData("https://api.instantwebtools.net/v1/passenger"); // getting array with number totalPassengers
        $passengers = $this->getAPIData("https://api.instantwebtools.net/v1/passenger?page=0&size=10");
            //. $data['totalPassengers']);  // getting the whole bunch of Passengers with airlines nested


        $fun = collect($passengers['data']);

        $search = $fun->filter(function($key,$value){
               // wishlist  iterieren until airline -> id  == $value
        });

        foreach($fun as $key => $value){
            foreach ($value  as $key_it => $value_it){
                    $filter[] = $value_it;
                }
            }

       // return $filter;
    }


}
