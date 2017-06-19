<?php

namespace App\Http\Controllers;

use App\Poi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PoiController extends Controller
{
    
    public function __construct(Poi $poi) {
        $this->poi = $poi;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Poi::get());
    }
    
    /**
     * Display a listing of the resource by proximity.
     * Used Haversine formula to calculate distance between latitude and longitude points
     * Font: http://www.movable-type.co.uk/scripts/latlong.html
     * @return \Illuminate\Http\Response
     */
    public function find($dmax = '', $coordenate_x = '', $coordenate_y = '')
    {
        
        $input = ['dmax' => $dmax, 'coordinate_x' => $coordenate_x, 'coordinate_y' => $coordenate_y];
        $rules = ['dmax' => 'required|min:0', 'coordinate_x' => 'required|min:0', 'coordinate_y' => 'required|min:0'];
        $validator = Validator::make($input, $rules);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        
        // Earth radius in proportion
        $earth_radius = 63.71;
        
        $list = DB::table('poi')
                     ->select(DB::raw('id, name, coordinate_x, coordinate_y, (' . $earth_radius . ' *
                                            acos(
                                                cos(radians(' . $coordenate_x . ')) *
                                                cos(radians(coordinate_x)) *
                                                cos(radians(' . $coordenate_y . ') - radians(coordinate_y)) +
                                                sin(radians(' . $coordenate_x . ')) *
                                                sin(radians(coordinate_x))
                                            )) AS distance
                                            '))
                     ->having('distance', '<=', $dmax)
                     ->get();
        
        return response()->json($list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $input = $request->all();
        $validator = Validator::make($input, $this->poi->rules);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        
        $this->poi->fill($input);
        $this->poi->save();

        return response()->json($this->poi, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Poi  $poi
     * @return \Illuminate\Http\Response
     */
    public function show($poi)
    {

        if(!$poi) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        return response()->json($poi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Poi  $poi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $poi)
    {

        $input = $request->all();
        
        if(!$poi) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }
        
        $validator = Validator::make($input, $this->poi->rules);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $poi->fill($input);
        $poi->save();

        return response()->json($poi);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Poi  $poi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poi $poi)
    {
        if(!$poi) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $poi->delete();
    }
}
