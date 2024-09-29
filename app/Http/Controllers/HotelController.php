<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function index()
    {
        // Retrieve hotels owned by the logged-in user
        $hotels = Hotel::where('owner_id', auth()->id())->get();
    
        // Pass hotels to the view
        return view('dashboard', compact('hotels'));
    }

    // Create hotel form
    public function create()
    {
        return view('hotels.create');
    }

    // Store hotel in DB
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Create a new hotel
        Hotel::create([
            'name' => $request->name,
            'address' => $request->address,
            'description' => $request->description,
            'owner_id' => auth()->id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Hotel created successfully!');
    }

    // Edit hotel
    public function edit($id)
    {
        $hotel = Hotel::where('owner_id', auth()->id())->findOrFail($id);
        return view('hotels.edit', compact('hotel'));
    }

    // Update hotel in the database
    public function update(Request $request, $id)
    {
        $hotel = Hotel::where('owner_id', auth()->id())->findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Update the hotel
        $hotel->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Hotel updated successfully!');
    }

    // Delete hotel
    public function destroy($id)
    {
        $hotel = Hotel::where('owner_id', auth()->id())->findOrFail($id);
        $hotel->delete();

        return redirect()->route('dashboard')->with('success', 'Hotel deleted successfully!');
    }
}
