<?php

namespace App\Http\Controllers;

use App\Http\Requests\MeasurementRequest;
use App\Models\Measurement;
use Illuminate\Http\Request;

class MeasurementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Measurement::select('type')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MeasurementRequest $request)
    {
        $active = request('active', true);
        Measurement::create([
            "type" => $request->type,
            "active" => $active
        ]);
        return response()->json([
            "message" => "created"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show thedeleted form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $active = request('active', true);
            $measurement = Measurement::find($id);
            $measurement->update([
                "type" => $request->type,
                "active" => $active
            ]);
            return response()->json([
                "message" => "updated"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "ma'lumot o'zgartirishda xatolik" . " " . $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $measurement = Measurement::destroy($id);

        return response()->json([
            'message' => $measurement == 0 ? "$id ID li o'lchov birligi topilmadi" : "o'lchov birligi o'chirildi"
        ]);	
    }
}
