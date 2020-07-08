<?php

namespace App\Http\Controllers;

use App\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller {

    public function index() {
        $places = Place::all();

        $response = [
            'status' => ($places->isNotEmpty()) ? 200 : 204,
            'data' => $places
        ];

        return response()->json($response);
    }

    public function fetch($id) {
        $place = Place::find($id);

        $response = [
            'status' => ($place) ? 200 : 204,
            'data' => $place
        ];

        return response()->json($response);
    }

    public function store(Request $request) {
        $vd = $request->validate([
            'name' => ['required', 'string'],
            'latitude' => ['required', 'string'],
            'longitude' => ['required', 'string']
        ]);

        $place = Place::create($vd);

        $response = [
            'status' => ($place) ? 201 : 500,
            'data' => $place
        ];

        return response()->json($response);
    }

    public function update(Request $request, $id) {
        $vd = $request->validate([
            'name' => ['required', 'string'],
            'latitude' => ['required', 'string'],
            'longitude' => ['required', 'string']
        ]);

        $response = [
            'status' => 200,
            'data' => null
        ];

        $place = Place::find($id);
        if(!$place) {
            $response['status'] = 404;
        } else {
            $place->name = $vd['name'];
            $place->latitude = $vd['latitude'];
            $place->longitude = $vd['longitude'];
    
            if($place->save()) {
                $response['status'] = 200;
                $response['data'] = $place;
            }
        }


        return response()->json($response);
    }

    public function delete($id) {
        $response = [
            'status' => 200,
            'data' => null
        ];

        $place = Place::find($id);
        if(!$place) {
            $response['status'] = 404;
        } else {
            if($place->delete()) {
                $response['status'] = 200;
            }
        }

        return response()->json($response);
    }
    
}
