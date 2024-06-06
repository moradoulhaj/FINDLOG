<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\House;
use Illuminate\Support\Facades\DB;
use App\Models\Room;
use App\Models\User;
use App\Models\Reservation;


class AdminController extends Controller
{
    public function home()
{
    if (Auth::check()) {
        $user = Auth::user();
        $usertype = $user->usertype;

        if ($usertype == "student") {
            // Si l'utilisateur est un étudiant
            $totalUsers = User::count();
            $totalHouses = House::count();
            $totalRooms = Room::count();
            return view('student.home', compact('totalUsers', 'totalRooms', 'totalHouses'));
        } elseif ($usertype == "landlord") {
            // Si l'utilisateur est un propriétaire (landlord)
            $houses = $user->houses()->withCount('rooms')->get();
            $houseCount = $houses->count();

            // Compter le nombre total de chambres des maisons du propriétaire
            $totalRooms = $houses->sum('rooms_count');

            // Récupérer toutes les réservations associées aux chambres des maisons du propriétaire
            $totalReservations = Reservation::whereIn('room_id', $houses->pluck('rooms')->flatten()->pluck('id'))->count();

            $firstName = $user->firstName;
            $lastName = $user->lastName;

            return view('landlord.home', compact('houseCount', 'totalRooms', 'totalReservations', 'firstName', 'lastName'));
        } elseif ($usertype == "admin") {
            // Si l'utilisateur est un administrateur
            $totalUsers = User::count();
            $totalHouses = House::count();
            $totalRooms = Room::count();
            $firstName = $user->firstName;
            $lastName = $user->lastName;
            return view('admin.home', compact('totalUsers', 'totalRooms', 'totalHouses', 'firstName', 'lastName'));
        }
    }

    return redirect()->back();
}



    public function index(){
        $totalUsers = DB::table('users')->count();
        $totalHouses = DB::table('houses')->count();
        $totalRooms = DB::table('rooms')->count();
        return view('student.home', compact('totalUsers','totalRooms' , 'totalHouses'));
    }
}
