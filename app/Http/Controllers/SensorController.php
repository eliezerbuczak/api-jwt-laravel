<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Sensor::all();

        return response()->json([
            'message' => 'List of sensors',
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request = $request->all();
        $id_user = auth()->user()->id;
        $request['id_user_created'] = $id_user;
        $sensor = Sensor::create($request);
        return response()->json([
            'message' => 'Sensor created',
            'data' => $sensor
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sensor = Sensor::find($id);
        return response()->json([
            'message' => 'Sensor found',
            'data' => $sensor
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request = $request->all();
        $id_user = auth()->user()->id;
        $request['id_user_updated'] = $id_user;
        $sensor = Sensor::find($id);
        $sensor->update($request);
        return response()->json([
            'message' => 'Sensor updated',
            'data' => $sensor
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id_user = auth()->user()->id;
        $sensor = Sensor::find($id);
        $sensor->id_user_deleted = $id_user;
        $sensor->save();
        $sensor->delete();
        return response()->json([
            'message' => 'Sensor deleted',
            'data' => $sensor
        ]);
    }
}
