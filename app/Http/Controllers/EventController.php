<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;

class EventController extends Controller
{
    function show(){
        return view('event-detail');
    }

    function checkout(){
        return view('checkout');
    }

    function ticket(){
        return view('ticket');
    }

    public function byCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $events = Event::where('category_id', $category->id)->get();

        return view('katalog', compact('events', 'category'));
    }


    public function filterByCategory(Request $request)
    {
        $query = Event::query();

        if ($request->has('category') && $request->category != '') {
            $category = Category::where('slug', $request->category)->first();

            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        $events = $query->latest()->get();

        return response()->json($events);
    }
}