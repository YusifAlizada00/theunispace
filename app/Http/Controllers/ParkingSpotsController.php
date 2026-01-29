<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateparkingSpotRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ParkingSpotsController extends Controller
{
    public function create(User $user)
    {
        if(Auth::user()->is_admin){
            return view('create-parking-spots', compact('user'));
        } else {
            abort(404, 'Not Found.');
        }
    }

    public function store(CreateparkingSpotRequest $request)
    {
        $data = $request->validated();

        \App\Models\ParkingSpot::create($data);

        return redirect()->route('parking-spots')->with('success', 'Parking Spot created successfully.');
    }

    public function show()
    {
        $parking_spots = \App\Models\ParkingSpot::latest()->get();
        return view('parking-spots', compact('parking_spots'));
    }
}
