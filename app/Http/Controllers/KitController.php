<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filter;
use App\Models\Kit;
use Illuminate\Support\Facades\Auth;

class KitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $filters = Filter::select('id', 'name')
    ->where('user_id', Auth::id())->with([
        'kits:id,name,brand,filter_id,user_id,kit_lifespan_days'
    ])
    ->get();
    // return $filters;
   
    // $kits = Kit::with(['filter:id,name'])->where('user_id', Auth::id())->latest()->get();

    return view('kit', [
        'title' => 'Kits',
        'filters' => $filters,
    ]);

}


    /**
     * Show the form for creating a new resource.
     */
   public function create()
{   
    $filters = Filter::where('user_id', Auth::id())
            ->latest()
            ->get();

    return view('kits.create', [
        'title' => 'Create Kit',
        'filters' => $filters,
    ]);
}

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {
        // echo $request->user();

        $validated = $request->validate([
            'filter_id' => 'required|exists:filters,id',
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'kit_lifespan_days' => 'required|integer|min:1',
        ]);
        $validated['user_id'] = Auth::id();


        Kit::create($validated);

        return redirect()
            ->route('kits')
            ->with('success', 'Kit created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "Kit Show: $id";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kit $kit)
    {
        abort_unless($kit->filter->user_id === auth()->id(), 403);
        $filters = Filter::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('kits.edit', [
            'title' => 'Edit Kit',
            'kit' => $kit,
            'filters' => $filters,
        ]);
    }

    public function update(Request $request, Kit $kit)
    {
        abort_unless($kit->filter->user_id === auth()->id(), 403);

        $validated = $request->validate([
            'filter_id' => 'required|exists:filters,id',
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'kit_lifespan_days' => 'required|integer|min:1',
    
        ]);

        $kit->update($validated);

        return redirect()->route('kits')
            ->with('success', 'Kit updated successfully.');
    }

    public function destroy(Kit $kit)
    {
        abort_unless($kit->filter->user_id === auth()->id(), 403);

        $kit->delete();

        return redirect()->route('kits')
            ->with('success', 'Kit deleted successfully.');
    }
}
