<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'starts_at' => 'required|date',
            'expires_at' => 'required|date|after:starts_at',
        ]);

        Event::create([
            'starts_at' => $request->starts_at,
            'expires_at' => $request->expires_at,
        ]);

        return redirect()->route('events.create')->with('success', 'Event created successfully.');
    }
}