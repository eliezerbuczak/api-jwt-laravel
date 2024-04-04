<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sensor extends Model
{
    use SoftDeletes;
    protected $table = 'sensors';
    protected $fillable = [
        'name',
        'description',
        'id_user_created',
        'id_user_updated',
        'id_user_deleted',
    ];

    public function getAll(): array
    {
        try{
            $data = Sensor::all();
            if($data){
                return [
                    'message' => 'Sensors found',
                    'data' => $data
                ];
            }
            return [
                'message' => 'Sensors not found',
                'data' => null
            ];
        }catch (\Exception $e){
            return [
                'message' => "Error: {$e->getMessage()}"
            ];
        }
    }

    public function saveSensor(array $data): array
    {
        $id_user = auth()->user()->id;
        $data['id_user_created'] = $id_user;

        try {
            $sensor = Sensor::create($data);
            return [
                'message' => 'Sensor created',
                'data' => $sensor
            ];
        } catch (\Exception $e) {
            return [
                'message' => "Error: {$e->getMessage()}"
            ];
        }
    }

    public function getSensorById(int $id): array
    {
        try {
            $sensor = Sensor::find($id);
            if ($sensor) {
                return [
                    'message' => 'Sensor found',
                    'data' => $sensor
                ];
            }
            return [
                'message' => 'Sensor not found',
                'data' => null
            ];
        } catch (\Exception $e) {
            return [
                'message' => "Error: {$e->getMessage()}"
            ];
        }
    }

    public function updateSensor(array $data, int $id): array
    {
        $id_user = auth()->user()->id;
        $data['id_user_updated'] = $id_user;

        try {
            $sensor = Sensor::find($id);
            if ($sensor) {
                $sensor->update($data);
                return [
                    'message' => 'Sensor updated',
                    'data' => $sensor
                ];
            }
            return [
                'message' => 'Sensor not found',
                'data' => null
            ];
        } catch (\Exception $e) {
            return [
                'message' => "Error: {$e->getMessage()}"
            ];
        }
    }

    public function deleteSensor(int $id): array
    {
        $id_user = auth()->user()->id;
        try {
            $sensor = Sensor::find($id);
            if ($sensor) {
                $sensor->id_user_deleted = $id_user;
                $sensor->save();
                $sensor->delete();
                return [
                    'message' => 'Sensor deleted',
                    'data' => $sensor
                ];
            }
            return [
                'message' => 'Sensor not found',
                'data' => null
            ];
        } catch (\Exception $e) {
            return [
                'message' => "Error: {$e->getMessage()}"
            ];
        }
    }

}
