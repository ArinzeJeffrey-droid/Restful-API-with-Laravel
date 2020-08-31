<?php

namespace App\Http\Controllers;

use App\CountryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CountryController extends Controller
{
    public function country(){
        return response()->json(CountryModel::get(), 200);
    }
    public function countryByID($id){
        $country = CountryModel::find($id);
        if(is_null($country)){
            return response()->json(["message" => "No country with that ID found"], 404);
        }
        return response()->json(CountryModel::find($id), 200);
    }
    public function addCountry(Request $request){
        //set validator rules
        $rules = [
            "name" => "required|min:3",
            "iso" => "required|min:2|max:2",
        ];
        //initialized validation
        $validator = Validator::make($request->all(), $rules);
        //check validations
        if($validator -> fails()){
            return response()->json($validator->errors(), 400);
        }
        $country = CountryModel::create($request->all());
        return response()->json($country, 201);
    }
    public function updateCountry(Request $request, $id){
        $country = CountryModel::find($id);
        if(is_null($country)){
            return response()->json(["message" => "can't update non existing record"], 404);
        }
        //set validator rules
        $rules = [
            "name" => "required|min:3",
            "iso" => "required|min:2|max:2",
        ];
        //initialized validation
        $validator = Validator::make($request->all(), $rules);
        //check validations
        if($validator -> fails()){
            return response()->json($validator->errors(), 400);
        }
        $country->update($request->all());
        return response()->json($id, 200);
    }
    public function deleteCountry(Request $request, $id){
        $country = CountryModel::find($id);
        if(is_null($country)){
            return response()->json(["message" => "can't delete non existing record"], 404);
        }
        $country->delete();
        return response()->json("Country deleted", 200);
    }
}


