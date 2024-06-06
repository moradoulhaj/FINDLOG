<?php

namespace App\Http\Controllers;
use App\Models\House;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HouseController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            $user = auth()->user();
            $firstName = $user->firstName;
            $lastName = $user->lastName;
            $houses = $user->houses;
            return view('landlord.houses.index', compact('houses' , 'firstName' , 'lastName'));
        } else {
            return redirect('http://127.0.0.1:8000/login');
        }

    }

    public function create()
    {
        $user = Auth::user();
        if ($user) {
            $user = auth()->user();
            $firstName = $user->firstName;
            $lastName = $user->lastName;
            return view('landlord.houses.create' , compact('firstName' , 'lastName'));
        } else {
            return redirect('http://127.0.0.1:8000/login');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nameHouse' => 'required|string|min:4',
            'NomberRoom' => 'required|numeric|min:1',
            'DistanceFac' => 'required|numeric|min:1',
            'HouseGender' => 'required|in:male,female', // Ajout de validation pour HouseGender
            'adresse' => 'required|string', // Ajout de validation pour l'adresse
        ]);
    
        $insert = new House();
        if ($request->has('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $path = 'houseimages';
            $file->move($path,$filename);
            $insert->photo = $filename;
        }
    
        $insert->nameHouse = $request->nameHouse;
        $insert->NomberRoom = $request->NomberRoom;
        $insert->DistanceFac = $request->DistanceFac;
        $insert->HouseGender = $request->HouseGender;
        $insert->adresse = $request->adresse;
        if (Auth::check()) {
            $insert->landlord_id = Auth::id();
        }
        $insert->save();
        return redirect()->route('landlord.rooms.create')->with('success', 'House created successfully.');
    }
    

    public function edit($id)
    {
        $house = House::findOrFail($id);
        // Check if the authenticated user is the owner of the house
        if (Auth::check() && $house->landlord_id == Auth::id()) {
            $user = auth()->user();
            $firstName = $user->firstName;
            $lastName = $user->lastName;
            return view('landlord.houses.edit', compact('house', 'firstName'  ,'lastName'));
        } else {
            return redirect('http://127.0.0.1:8000/login');
        }
    }

    public function update(Request $request, $id)
    {
        $house = House::findOrFail($id);
    
        // Vérifier si l'utilisateur authentifié est le propriétaire de la maison
        if (Auth::check() && $house->landlord_id == Auth::id()) {
            $request->validate([
                'nameHouse' => 'required|string|min:4',
                'NomberRoom' => 'required|numeric|min:1',
                'DistanceFac' => 'required|numeric|min:1',
                'HouseGender' => 'required|in:male,female', // Ajout de validation pour HouseGender
                'adresse' => 'required|string', // Ajout de validation pour l'adresse
            ]);
    
            // Mettre à jour les champs de la maison
            $house->nameHouse = $request->nameHouse;
            $house->NomberRoom = $request->NomberRoom;
            $house->DistanceFac = $request->DistanceFac;
            $house->HouseGender = $request->HouseGender;
            $house->adresse = $request->adresse;
            $house->save();
    
            return redirect('http://127.0.0.1:8000/landlord/house')->with('success', 'House updated successfully.');
        } else {
            return redirect('http://127.0.0.1:8000/login');
        }
    }
    
    public function destroy($id)
    {
        // Récupérer la maison à supprimer
        $house = House::findOrFail($id);
    
        // Vérifier si l'utilisateur est authentifié et s'il est le propriétaire de la maison
        if (Auth::check() && $house->landlord_id == Auth::id()) {
            // Supprimer les chambres associées à cette maison
            $house->rooms()->delete();
    
            // Supprimer la maison
            $house->delete();
    
            return redirect()->route('landlord.house.index')->with('success', 'House and its rooms deleted successfully.');
        } else {
            return redirect()->route('login')->with('error', 'You are not authorized to delete this house.');
        }
    }



    //user functions
    public function housesUsers()
    {
        $houses = House::all() ;
        return view('student.Houses.index', compact('houses'));
    }


    public function showLandlordInfo(House $house)
    {
        $landlord = $house->landlord;
        // le test de connexion
        if (auth()->check() && auth()->user()->usertype != 'student'){
            return redirect()->route('home')->with('error', 'Sorry but you\'re not a student');

        }
    
        return view('student.Houses.landlordInfo', compact('landlord'));

        
    }

    public function showRooms(House $house)
    {
        $rooms = $house->rooms;
        return view('student.Houses.rooms', compact('rooms'));
}
}
