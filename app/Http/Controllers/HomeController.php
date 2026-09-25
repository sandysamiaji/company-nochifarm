<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Fetch live stock from database (nochifram / nochifarminput)
        try {
            $sumCoops = (int) DB::table('coops')->where('is_active', 1)->sum('active_chickens');
            if ($sumCoops > 0) {
                $totalActiveChickens = $sumCoops;
            } else {
                $totalActiveChickens = (int) DB::table('flocks')->where('is_active', 1)->sum('current_population');
            }

            if ($totalActiveChickens <= 0) {
                $totalActiveChickens = 2250;
            }

            $primaryBreed = DB::table('flocks')->where('is_active', 1)->value('breed') ?: 'Lohmann Brown-Extra';
        } catch (\Throwable $e) {
            $totalActiveChickens = 2250;
            $primaryBreed = 'Lohmann Brown-Extra';
        }

        return view('welcome', compact('totalActiveChickens', 'primaryBreed'));
    }
}
