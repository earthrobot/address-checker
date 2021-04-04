<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use MoveMoveIo\DaData\Enums\Language;
use MoveMoveIo\DaData\Facades\DaDataAddress;

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

            $result = DaDataAddress::standardization($data["address"])[0];

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

        } catch (\Exception $e) {
            flash($e->getMessage(), 'danger');
        }
     
        return redirect()->route('home');
    }

}
