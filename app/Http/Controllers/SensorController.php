<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $data = new Sensor();
        try{
            $sensor = $data->getAll();
            $data = $sensor['data'];
            $message = $sensor['message'];
            return response()->json([
                'message' => $message,
                'data' => $data
            ],200);
        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request = $request->all();
        $data = new Sensor();
        try{
            $sensor = $data->saveSensor($request);
            $data = $sensor['data'];
            $message = $sensor['message'];
            return response()->json([
                'message' => $message,
                'data' => $data
            ], 201);
        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Http\JsonResponse
    {
        $data = new Sensor();
        try{
            $sensor = $data->getSensorById($id);
            $data = $sensor['data'];
            $message = $sensor['message'];
            return response()->json([
                'message' => $message,
                'data' => $data
            ],200);
        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): \Illuminate\Http\JsonResponse
    {
        $request = $request->all();
        $data = new Sensor();
        try{
            $sensor = $data->updateSensor($request, $id);
            $data = $sensor['data'];
            $message = $sensor['message'];
            return response()->json([
                'message' => $message,
                'data' => $data
            ]);
        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $data = new Sensor();
        try{
            $sensor = $data->deleteSensor($id);
            $data = $sensor['data'];
            $message = $sensor['message'];
            return response()->json([
                'message' => $message,
                'data' => $data
            ]);
        }catch (\Exception $e){
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
