<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Partner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Event::with('category')->orderBy('date', 'asc');

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $events = $query->get();

        // Ambil semua partner untuk ditampilkan di homepage (UTS Soal 4)
        $partners = Partner::all();

        return view('welcome', compact('events', 'categories', 'partners'));
    }
}
