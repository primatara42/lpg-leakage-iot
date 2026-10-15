<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorReading extends Model
{
    //
    protected $fillable = [
        'gas_ppm',
        'smoke_detected',
        'temperature',
        'humidity',
    ];

    protected function casts(): array
    {
        return [
            'gas_ppm' => 'float',
            'smoke_detected' => 'boolean',
            'temperature' => 'float',
            'humidity' => 'float',
        ];
    }
}
