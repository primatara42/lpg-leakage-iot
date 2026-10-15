
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SensorReadingController;

Route::get('/sensor-readings', [
    SensorReadingController::class,
    'index',
]);

Route::get('/sensor-readings/latest', [
    SensorReadingController::class,
    'latest',
]);

Route::post('/sensor-readings', [
    SensorReadingController::class,
    'store',
]);
