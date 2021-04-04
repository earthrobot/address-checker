<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses_by_regions = Address::all()->groupBy('region_with_type');
        return response()->view('addresses.index', compact('addresses_by_regions'));
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
            "full_address" => 'required',
            "federal_district" => 'max:255',
            "region_with_type" => 'max:255',
            "area_with_type" => 'max:255',
            "city_with_type" => 'max:255',
            "city_district_with_type" => 'max:255',
            "settlement_with_type" => 'max:255',
            "street_with_type" => 'max:255',
            "house_type_full" => 'max:255',
            "house" => 'max:255'
        ]);
    
        try {

            if (Address::whereNotNull("city_with_type")->firstWhere("city_with_type", $data["city_with_type"]) != null
             || Address::whereNotNull("settlement_with_type")->firstWhere("settlement_with_type", $data["settlement_with_type"]) != null){
                flash("В базе имеются адреса в вашем населенном пункте")->info();
            }

            if (!Address::where("full_address", $data["full_address"])->exists()) {
                $address = new Address();
                $address->fill($data);
                $address->save();
            }

        } catch (\Exception $e) {

            flash($e->getMessage(), 'danger');
            
        }
     
        return redirect()->route('home');
    }

}
