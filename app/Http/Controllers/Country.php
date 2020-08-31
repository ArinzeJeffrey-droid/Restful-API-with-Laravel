<?php

namespace App\Http\Controllers;

use App\CountryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class Country extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(CountryModel::get(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = CountryModel::find($id);
        if(is_null($country)){
            return response()->json(["message" => "No country with that ID found"], 404);
        }
        return response()->json(CountryModel::find($id), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = CountryModel::find($id);
        if(is_null($country)){
            return response()->json(["message" => "can't delete non existing record"], 404);
        }
        $country->delete();
        return response()->json("Country deleted", 200);
    }
}
