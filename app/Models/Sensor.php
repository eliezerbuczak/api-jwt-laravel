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


}
