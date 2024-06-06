<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    //
    

public function store(Request $request)
{
    // Validation des données
    $request->validate([
        // Ajoutez les règles de validation selon vos besoins
    ]);

    // Création de la réservation
    $reservation = new Reservation();
    $reservation->status = 'pending'; // ou tout autre statut initial
    $reservation->user_id = auth()->id(); // ou tout autre moyen d'obtenir l'ID de l'utilisateur
    $reservation->room_id = $request->input('room_id'); // ou tout autre moyen d'obtenir l'ID de la chambre
    $reservation->save();

    // Redirection avec un message de succès
    return redirect()->route('student.houses.index')->with('success', 'Room reserved successfully wait for owner call to complete the process.');
}
public function reserveRoom($roomId)
{
    // Vérifie si l'utilisateur est authentifié et s'il est un étudiant
    if (Auth::check() && Auth::user()->usertype === 'student') {
        $userId = Auth::id();

        // Vérifie si l'étudiant a déjà réservé cette chambre
        $existingReservation = Reservation::where('user_id', $userId)
            ->where('room_id', $roomId)
            ->exists();

        if ($existingReservation) {
            // Si une réservation existe déjà pour cette chambre, redirige avec un message d'erreur
            return redirect()->back()->with('error', 'You have already reserved this room.');
        }

        // Vérifier le nombre total de réservations de l'étudiant
        $totalReservations = Reservation::where('user_id', $userId)->count();

        // Limiter le nombre de réservations à 4
        if ($totalReservations >= 4) {
            return redirect()->back()->with('error', 'You have reached the maximum limit of reservations (4).');
        }

        // Sinon, crée une nouvelle réservation
        Reservation::create([
            'user_id' => $userId,
            'room_id' => $roomId,
            'status' => 'pending', // Ou un autre statut par défaut
        ]);

        // Redirige avec un message de succès
        return redirect()->route('user.reservations')->with('success', 'Room reserved successfully.');
    }

    // Si l'utilisateur n'est pas authentifié ou n'est pas un étudiant, redirige vers la page de connexion
    return redirect()->route('login');
}
public function userReservations()
{
    // Vérifie si l'utilisateur est authentifié
    if (Auth::check()) {
        // Récupère l'ID de l'utilisateur connecté
        $userId = Auth::id();
        
        // Récupère les réservations de l'utilisateur
        // $reservations = Reservation::where('user_id', $userId)->get();
        $reservations = Reservation::where('user_id', $userId)->with('room')->get();
        // Passer les réservations à la vue
        return view('student.studentReservations', compact('reservations'));
    }

    // Si l'utilisateur n'est pas authentifié, redirige-le vers la page de connexion
    return redirect()->route('login');
}

public function cancel($id)
{
    // Trouver la réservation à annuler
    $reservation = Reservation::findOrFail($id);

    // Vérifier si l'utilisateur est autorisé à annuler cette réservation
    if (Auth::check() && Auth::id() === $reservation->user_id) {
        // Supprimer la réservation de la base de données
        $reservation->delete();

        // Rediriger l'utilisateur avec un message de succès
        return redirect()->back()->with('success', 'Reservation canceled successfully.');
    } else {
        // Rediriger l'utilisateur avec un message d'erreur s'il n'est pas autorisé
        return redirect()->back()->with('error', 'You are not authorized to cancel this reservation.');
    }
}

public function landlordReservations()
{
    // Vérifie si le propriétaire est authentifié
    if (Auth::check() && Auth::user()->usertype === 'landlord') {
        // Récupère l'ID du propriétaire connecté
        $landlordId = Auth::id();
        
        // Récupère les chambres appartenant au propriétaire
        // $rooms = Room::where('landlord_id', $landlordId)->get();
        $rooms = Room::whereHas('house', function ($query) use ($landlordId) {
            $query->where('landlord_id', $landlordId);
        })->get();

        // Récupère les informations du propriétaire connecté
        $landlord = Auth::user();

        // Récupère les réservations associées à ces chambres
        $reservations = Reservation::whereIn('room_id', $rooms->pluck('id'))->get();

        // Retourne la vue avec les réservations
        return view('landlord.reservations.index', compact('reservations','landlord'));
    } else {
        // Si le propriétaire n'est pas authentifié, redirige vers la page de connexion
        return redirect()->route('login');
    }
}
public function accept($id)
{
    // Recherche de la réservation
    $reservation = Reservation::findOrFail($id);

    // Mise à jour du statut de la réservation
    $reservation->update(['status' => 'accepted']);

    // Mise à jour du statut de la chambre associée
    $room = $reservation->room;
    $room->update(['status' => 'occupied']);

    // Redirection avec un message de succès
    return redirect()->back()->with('success', 'Reservation accepted successfully.');
}

public function decline($id)
{
    // Recherche de la réservation
    $reservation = Reservation::findOrFail($id);

    // Mise à jour du statut de la réservation
    $reservation->update(['status' => 'declined']);

    // Mise à jour du statut de la chambre associée
    $room = $reservation->room;
    $room->update(['status' => 'available']);

    // Redirection avec un message de succès
    return redirect()->back()->with('success', 'Reservation declined successfully.');
}
}
