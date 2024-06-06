<?php

namespace App\Http\Controllers;
use App\Models\House;
use App\Models\Room;
use App\Models\User;

use Illuminate\Http\Request;

class devController extends Controller
{
    //

    public function showUsers()
    {
        $user = auth()->user();
        $firstName = $user->firstName;
        $lastName = $user->lastName;
        $users = User::all();
        return view('admin.users.index', compact('users','firstName','lastName'));
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        $user->houses()->delete();


        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted succesfully.');
    }

    public function showHouses()
    {
        $user = auth()->user();
        $firstName = $user->firstName;
        $lastName = $user->lastName;
        $usersWithHouses = User::has('houses')->with('houses')->get();
        return view('admin.houses.index', compact('usersWithHouses','firstName','lastName'));
    }

    public function deleteHouse($id)
    {
        $house = House::findOrFail($id);

        $house->delete();
        return redirect()->route('admin.houses')->with('success', 'house deleted succesfully.');
    }

    public function showRooms()
    {
        $user = auth()->user();
        $firstName = $user->firstName;
        $lastName = $user->lastName;
        $housesWithRooms = House::has('rooms')->with('rooms')->get();
        return view('admin.rooms.index', compact('housesWithRooms','firstName','lastName'));
    }

    public function deleteRooms($id)
    {
        $room = Room::findOrFail($id);

        $room->delete();
        return redirect()->route('admin.rooms')->with('success', 'Room deleted succesfully.');
    }
}

