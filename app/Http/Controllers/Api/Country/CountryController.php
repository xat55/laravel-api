<?php

namespace App\Http\Controllers\Api\Country;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;

use App\Models\Country;

use Validator;

class CountryController extends Controller
{
  // private function checkError()
  // {
  //   try {
  //     $user = auth()->userOrFail();
  //   } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
  //
  //     return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
  //   }
  // }

  public function country()
  {
    return response()->json(Country::get(), 200);
  }

  public function countryById($id)
  {
    $country = Country::find($id);

    if (is_null($country)) {
      return response()->json(['error' => true, 'message' => 'Page not found'], 404);
    }
    return response()->json($country, 200);
  }

  public function countrySave(Request $request)
  {
    $country = Country::create($request->all());

    $rules = [
      'iso' => 'required|between:2,2',
      'name' => 'required|min:3',
      'name_en' => 'required|min:3',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return response()->json($validator->errors(), 400);
    }

    return response()->json($country, 201);
  }

  public function countryEdit(Request $request, $id)
  {
    $country = Country::create($request->all());

    $rules = [
      'iso' => 'required|between:2,2',
      'name' => 'required|min:3',
      'name_en' => 'required|min:3',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return response()->json($validator->errors(), 400);
    }

    $country = Country::find($id);

    if (is_null($country)) {
      return response()->json(['error' => true, 'message' => 'Page not found'], 404);
    }
    $country->update($request->all());

    return response()->json($country, 200);
  }

  public function countryDelete(Request $request, Country $country)
  {
    $country = Country::find($country);

    if (is_null($country)) {
      return response()->json(['error' => true, 'message' => 'Page not found'], 404);
    }
    $country->delete();

    return response()->json('', 204);
  }
}
