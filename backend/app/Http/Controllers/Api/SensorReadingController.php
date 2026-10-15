<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SensorReading;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SensorReadingController extends Controller
{
    /**
     * Menampilkan 20 pembacaan sensor terbaru.
     */
    public function index(): JsonResponse
    {
        $readings = SensorReading::query()
            ->latest()
            ->limit(20)
            ->get();

        return response()->json([
            'message' => 'Data pembacaan sensor berhasil diambil.',
            'data' => $readings,
        ]);
    }

    /**
     * Menyimpan pembacaan sensor baru.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'gas_ppm' => ['nullable', 'numeric', 'min:0'],
            'smoke_detected' => ['required', 'boolean'],
            'temperature' => ['nullable', 'numeric'],
            'humidity' => ['nullable', 'numeric', 'between:0,100'],
        ]);

        $reading = SensorReading::create($validated);

        return response()->json([
            'message' => 'Data sensor berhasil disimpan.',
            'data' => $reading,
        ], 201);
    }

    /**
     * Mengambil satu pembacaan sensor paling baru.
     */
    public function latest(): JsonResponse
    {
        $reading = SensorReading::query()
            ->latest()
            ->first();

        if ($reading === null) {
            return response()->json([
                'message' => 'Belum ada data pembacaan sensor.',
                'data' => null,
            ]);
        }

        return response()->json([
            'message' => 'Data sensor terbaru berhasil diambil.',
            'data' => $reading,
        ]);
    }
}
