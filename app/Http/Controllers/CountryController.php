<?php

namespace App\Http\Controllers;

use App\CountryModel;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function country(){
        return response()->json(CountryModel::get(), 200);
    }
    public function countryByID($id){
        return response()->json(CountryModel::find($id), 200);
    }
    public function addCountry(Request $request){
        $country = CountryModel::create($request->all());
        return response()->json($country, 201);
    }
    public function updateCountry(Request $request, CountryModel $country){
        $country->update($request->all());
        return response()->json($country, 200);
    }
    public function deleteCountry(Request $request, CountryModel $country){
        $country->delete();
        return response()->json("Country deleted", 200);
    }
}
