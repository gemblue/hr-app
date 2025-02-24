<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Presence;

class DashboardController extends Controller
{
    /**
     * Display stats.
     */
    public function index()
    {
        $tasks = Task::all();

        return view('dashboard.index', compact('tasks'));
    }

    public function presence()
    {
        $data = Presence::where('status', 'present')
                ->selectRaw('MONTH(date) as month, YEAR(date) as year, COUNT(*) as total_present')
                ->groupBy('year', 'month')
                ->orderBy('month', 'asc')
                ->get();

        $temp = [];
        $i = 0;

        foreach ($data as $item) {
            $temp[$i] = $item->total_present;
            $i++;
        }

        return response()->json($temp);
    }
}