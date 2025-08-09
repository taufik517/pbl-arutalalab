<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;   

class BookingController extends Controller
{
    //
    public function index()
    {
    {
        $booking = \App\Models\Booking::orderBy('created_at', 'asc')->get();
        return view('booking.index', compact('booking'));
    }
    }

    public function create()
    {
        $token = config('services.room_service.token');
        $response = Http::withToken($token)->get('http://room-service-nginx/api/rooms');
        $rooms = $response->ok() ? $response->json() : [];
        return view('booking.create', compact('rooms'));
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'user_id' => 'required|integer',
        'room_id' => 'required|integer',
        'title' => 'required|string',
        'start_time' => 'required|date_format:Y-m-d\TH:i',
        'end_time' => 'required|date_format:Y-m-d\TH:i|after:start_time',
    ]);

    \App\Models\Booking::create($validated);
        return redirect()->route('booking.index')->with('success', 'Booking berhasil ditambahkan!');
    }

    public function edit(Booking $booking)
    {
        return view('booking.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'room_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'start_time' => 'required|date_format:Y-m-d\TH:i',
            'end_time' => 'required|date_format:Y-m-d\TH:i|after:start_time',
        ]);

        $booking->update([
            'user_id' => $request->user_id,
            'room_id' => $request->room_id,
            'title' => $request->title,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('booking.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        // Logic to delete a booking
        $booking->delete();

        return redirect()->route('booking.index')->with('success', 'Booking deleted successfully.');
    }
}