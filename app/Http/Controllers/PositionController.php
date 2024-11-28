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
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $query->orderBy('name', "asc");
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
        $isNull=$request->input('reports_to');
        
        if(!$isNull){
            $hasNull=Position::where('reports_to','=',null)->get();
            if(count($hasNull)>0)
                return response()->json(["message"=>"Only One Position can report to null"], 500); 
        }       
        $position = Position::create($validated);
        return response()->json($position, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $position=Position::find($id);
        return response()->json($position, 200);

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
