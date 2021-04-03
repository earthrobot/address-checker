<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\ConnectionException;
use Dadata\DadataClient;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Address::all();
        return response()->view('addresses.index', compact('addresses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            "address" => "required"
        ]);
    
        try {
            $token = "fc1b9ae85298ff9ee8d5fbd17e4b11412745c7f4";
            $secret = "a4085bbc2e368c75886f4b146955dbe396d5f27b";
            $dadata = new DadataClient($token, $secret);
            $result = $dadata->clean("address", $data["address"]);

            if ($result["city_with_type"] != null) {
                if (Address::firstWhere("city_with_type", $result["city_with_type"]) != null){
                    flash("В базе имеются адреса в вашем городе")->info();
                }
            } elseif ($result["settlement_with_type"] != null) {
                if (Address::firstWhere("settlement_with_type", $result["settlement_with_type"]) != null){
                    flash("В базе имеются адреса в вашем поселении")->info();
                }
            }
            
            if (Address::firstWhere("full_address", $result["result"]) == null) {
                $address = new Address();
                $address->fill([
                    "full_address" => $result["result"],
                    "federal_district" => $result["federal_district"],
                    "region_with_type" => $result["region_with_type"],
                    "area_with_type" => $result["area_with_type"],
                    "city_with_type" => $result["city_with_type"],
                    "city_district_with_type" => $result["city_district_with_type"],
                    "settlement_with_type" => $result["settlement_with_type"],
                    "street_with_type" => $result["street_with_type"],
                    "house_type_full" => $result["house_type_full"],
                    "house" => $result["house"]
                ]);
        
                $address->save();
            }

        } catch (RequestException | ConnectionException $e) {
            flash($e->getMessage(), 'danger');
        }
     
        return redirect()->route('home');
    }

}
