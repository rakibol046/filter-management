<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filter;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       $filters = Filter::where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return view('filter', [
            'title' => 'Filters',
            'filters' => $filters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
{
    return view('filters.create', [
        'title' => 'Create Filter',
    ]);
}

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {
        // echo $request->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $validated['user_id'] = $request->user()->id;

        Filter::create($validated);

        return redirect()
            ->route('filters')
            ->with('success', 'Filter created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "Filter Show: $id";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Filter $filter)
    {
        abort_unless($filter->user_id === auth()->id(), 403);

        return view('filters.edit', [
            'title' => 'Edit Filter',
            'filter' => $filter,
        ]);
    }

    public function update(Request $request, Filter $filter)
    {
        abort_unless($filter->user_id === auth()->id(), 403);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $filter->update($validated);

        return redirect()->route('filters')
            ->with('success', 'Filter updated successfully.');
    }

    public function destroy(Filter $filter)
    {
        abort_unless($filter->user_id === auth()->id(), 403);

        $filter->delete();

        return redirect()->route('filters')
            ->with('success', 'Filter deleted successfully.');
    }
}
