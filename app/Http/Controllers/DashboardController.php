<?php

namespace App\Http\Controllers;

use App\Models\ChangeHistory;
use App\Models\Filter;
use App\Models\Kit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $totalFilters = Filter::where('user_id', $userId)->count();

        $totalKits = Kit::where('user_id', $userId)->count();

        $expiringSoon = ChangeHistory::where('user_id', $userId)
            ->whereDate('next_change_date', '>=', Carbon::today())
            ->whereDate('next_change_date', '<=', Carbon::today()->copy()->addDays(5))
            ->count();

        $upcomingHistories = ChangeHistory::with([
                'filter:id,name',
                'kit:id,name'
            ])
            ->where('user_id', $userId)
            ->whereDate('next_change_date', '>=', Carbon::today())
            ->orderBy('next_change_date')
            ->take(5)
            ->get();

        return view('dashboard', [
            'title' => 'Dashboard',
            'totalFilters' => $totalFilters,
            'totalKits' => $totalKits,
            'expiringSoon' => $expiringSoon,
            'upcomingHistories' => $upcomingHistories,
        ]);
    }
}