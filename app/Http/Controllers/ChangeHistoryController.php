<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filter;
use App\Models\Kit;
use App\Models\ChangeHistory;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ChangeHistoryController extends Controller
{
    public function index(Request $request)
    {
        $changeHistories = ChangeHistory::with(['filter:id,name', 'kit:id,name,kit_lifespan_days'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
        // return $changeHistories;
        return view('history', [
            'title' => 'Change Histories',
            'histories' => $changeHistories,
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
        $validated = $request->validate([
            'filter_id'   => 'required|exists:filters,id',
            'kit_id'      => 'required|exists:kits,id',
            'change_date' => 'required|date',
        ]);

        $kit = Kit::findOrFail($validated['kit_id']);

        $validated['user_id'] = Auth::id();

        $validated['next_change_date'] = Carbon::parse($validated['change_date'])
            ->addDays($kit->kit_lifespan_days)
            ->toDateString();

        $validated['status'] = true;

        ChangeHistory::create($validated);

        return redirect()
            ->route('history')
            ->with('success', 'Kit installed successfully.');
    }
}
