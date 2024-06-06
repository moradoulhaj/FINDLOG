<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function index()
    {
        $user = Auth::user();
    
        // Check if the user is authenticated
        if ($user) {
            $user = auth()->user();
            $firstName = $user->firstName;
            $lastName = $user->lastName;
    
            // Fetch houses owned by the user along with their rooms
            $housesWithRooms = $user->houses()->has('rooms')->with('rooms')->get();
    
            return view('landlord.rooms.index', compact('housesWithRooms', 'firstName', 'lastName'));
        } else {
            return redirect('http://127.0.0.1:8000/login');
        }
    }
    


    public function create()
{
    // Vérifie si l'utilisateur est authentifié
    if (Auth::check()) {
        $user = auth()->user();

        // Vérifie si l'utilisateur possède au moins une maison
        if ($user->houses->count() > 0) {
            $firstName = $user->firstName;
            $lastName = $user->lastName;
            $houses = $user->houses;
            return view('landlord.rooms.create', compact('houses', 'firstName', 'lastName'));
        } else {
            // Si l'utilisateur n'a pas de maison, redirige-le vers une autre page
            return redirect()->route('landlord.house.index')->with('error', 'You need to create a house before creating a room.');
        }
    } else {
        // Si l'utilisateur n'est pas authentifié, redirige-le vers la page de connexion
        return redirect()->route('login');
    }
}


    public function store(Request $request)
    {
        $request->validate([
            'Longueur' => 'required|numeric|min:1',
            'largeur' => 'required|numeric|min:1',
            'Photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required',
            'price' => 'required|numeric|min:1',
            'id_house' => 'required|exists:houses,id',
        ]);

        // Check if the maximum number of rooms per house is reached
        $houseId = $request->id_house;
        $house = House::findOrFail($houseId);
        $numberOfRooms = $house->rooms()->count();
        $maxNumberOfRooms = $house->NomberRoom;

        if ($numberOfRooms >= $maxNumberOfRooms) {
            return redirect()->route('landlord.rooms.index')->with('error', 'You already created the maximum number of rooms allowed for this house.');
        }

        $room = new Room();
        $room->Longueur = $request->Longueur;
        $room->largeur = $request->largeur;
        $room->price = $request->price;
        
        // Handling room photo upload
        if ($request->hasFile('Photo')) {
            $image = $request->file('Photo');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('roomimages'), $imageName);
            $room->Photo = 'roomimages/'.$imageName;
        }

        $room->status = $request->status;
        $room->id_house = $request->id_house;
        $room->save();

        return redirect()->route('landlord.rooms.index')->with('success', 'Room created successfully!');
    }

    public function edit($id)
{
    // Récupérer la chambre spécifique à éditer en fonction de l'identifiant $id
    $room = Room::findOrFail($id);

    // Récupérer la maison à laquelle la chambre appartient
    $house = $room->house;

    // Vérifier si l'utilisateur est authentifié et s'il est le propriétaire de la maison
    if (Auth::check() && $house->landlord_id == Auth::id()) {
        // Récupérer les données de l'utilisateur authentifié
        $user = auth()->user();
        $firstName = $user->firstName;
        $lastName = $user->lastName;
        $houses = $user->houses;


        // Retourner la vue d'édition de la chambre avec les données de la chambre et du propriétaire
        return view('landlord.rooms.edit', compact('room', 'firstName', 'lastName', 'houses'));
    } else {
        // Rediriger l'utilisateur vers la page de connexion
        return redirect('http://127.0.0.1:8000/login');
    }
}

public function update(Request $request, $id)
{
    $room = Room::findOrFail($id);

    // Vérifie si l'utilisateur authentifié est le propriétaire de la chambre
    if (Auth::check() && $room->house->landlord_id == Auth::id()) {
        $request->validate([
            'Longueur' => 'required|numeric|min:1',
            'largeur' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1',
            'status' => 'required|string|in:available,occupied',
            'id_house' => 'required|exists:houses,id'
        ]);

        $room->Longueur = $request->Longueur;
        $room->largeur = $request->largeur;
        $room->price = $request->price;
        $room->status = $request->status;
        $room->id_house = $request->id_house;
        $room->save();

        return redirect()->route('landlord.rooms.index')->with('success', 'Room updated successfully.');
    } else {
        return redirect()->route('login');
    }
}

public function destroy($id)
{
    // Récupérer la chambre à supprimer
    $room = Room::findOrFail($id);

    // Vérifier si l'utilisateur est authentifié et s'il est le propriétaire de la maison de la chambre
    if (Auth::check() && $room->house->landlord_id == Auth::id()) {
        // Supprimer la chambre
        $room->delete();

        return redirect()->route('landlord.rooms.index')->with('success', 'Room deleted successfully.');
    } else {
        return redirect()->route('login')->with('error', 'You are not authorized to delete this room.');
    }
}


    public function changeStatus(Request $request, $id)
    {
        // Find the room
        $room = Room::findOrFail($id);
        
        // Toggle room status
        $room->status = ($room->status === 'available') ? 'occupied' : 'available';
        $room->save();
    
        // Redirect back with success message
        return back()->with('success', 'Room status updated successfully.');
    }



}
