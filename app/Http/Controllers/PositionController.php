<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
        $query = Position::query();
        return response()->json($query->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:positions,name',
            'reports_to' => 'nullable|exists:positions,id',
        ]);
        
        $position = Position::create($validated);
        return response()->json($position, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id){

        $position = Position::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|unique:positions,name,' . $id,
            'reports_to' => 'nullable|exists:positions,id',
        ]);

        $position->update($validated);
        return response()->json($position);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        $position = Position::findOrFail($id);
        $position->delete();
        return response()->json(['message' => 'Position deleted']);
    }
}