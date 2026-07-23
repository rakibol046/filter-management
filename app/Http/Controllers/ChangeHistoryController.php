<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filter;
use App\Models\Kit;
use Illuminate\Support\Facades\Auth;

class ChangeHistoryController extends Controller
{
    public function index(Request $request)
    {
        // $changeHistories = $request->user()->changeHistories()->with(['filter', 'kit'])->latest()->get();

        return view('history', [
            'title' => 'Change Histories',
            // 'changeHistories' => $changeHistories,
        ]);
    }
    public function create(Request $request)
    {   
        $filter = Filter::findOrFail($request->filter_id);

        $kits = $filter->kits()->where('user_id', Auth::id())->get();
        // return $kits;

        return view('history.create', [
            'title' => 'Install Kit',
            'filter' => $filter,
            'kits' => $kits,
        ]);
    }

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
}
