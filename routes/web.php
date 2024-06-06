<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\devController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[AdminController::class , 'index']);
Route::get('/home',[AdminController::class , 'home'])->name('home');


//house router
Route::get('/landlord/house',[HouseController::class,'index'])->name('landlord.house.index');
Route::get('/landlord/house/create', [HouseController::class, 'create'])->name('landlord.house.create');
Route::post('/landlord/house', [HouseController::class, 'store'])->name('landlord.house.store');
Route::get('/landlord/house/{id}/edit', [HouseController::class, 'edit'])->name('landlord.house.edit');
Route::put('/landlord/house/{id}', [HouseController::class, 'update'])->name('landlord.house.update');
Route::delete('/landlord/house/{id}', [HouseController::class, 'destroy'])->name('landlord.house.destroy');

//student part
Route::get('/houses',[HouseController::class,'housesUsers'])->name('student.houses.index');
Route::get('/houses/{house}/landlord', [HouseController::class, 'showLandlordInfo'])->name('landlord.info')->middleware('auth');
Route::get('/houses/{house}/rooms', [HouseController::class, 'showRooms'])->name('house.rooms');

//reservation part
Route::post('/reservation/store', [ReservationController::class, 'store'])->name('reservation.store')->middleware('auth');
Route::middleware(['auth', 'student'])->post('/reserve-room/{roomId}', [ReservationController::class, 'reserveRoom'])->name('reserve.room');
Route::get('/user/reservations', [ReservationController::class, 'userReservations'])->name('user.reservations');
Route::delete('/cancel-reservation/{id}', [ReservationController::class, 'cancel'])->name('cancelReservation');
Route::get('/landlord/reservations', [ReservationController::class, 'landlordReservations'])->name('landlord.reservations.index');
Route::get('/accept-reservation/{id}', [ReservationController::class, 'accept'])->name('acceptReservation');
Route::get('/decline-reservation/{id}', [ReservationController::class, 'decline'])->name('declineReservation');




//room router :
Route::get('/landlord/rooms',[RoomController::class,'index'])->name('landlord.rooms.index');
Route::get('/landlord/room/create',[RoomController::class,'create'])->name('landlord.rooms.create');
Route::post('/landlord/room',[RoomController::class,'store'])->name('landlord.rooms.store');
Route::get('/landlord/room/{id}/edit', [RoomController::class, 'edit'])->name('landlord.room.edit');
Route::put('/landlord/room/{id}', [RoomController::class, 'update'])->name('landlord.room.update');
Route::delete('/landlord/room/{id}', [RoomController::class, 'destroy'])->name('landlord.room.destroy');
Route::post('/room/{id}/change-status', [RoomController::class, 'changeStatus'])->name('room.changeStatus');

//admin router
Route::get('/admin/users', [devController::class, 'showUsers'])->name('admin.users');
Route::get('/admin/users/{id}/edit', 'devController@editUser')->name('admin.user.edit');
Route::delete('/admin/users/{id}', [devController::class, 'deleteUser'])->name('admin.user.delete');
Route::get('/admin/houses', [devController::class, 'showHouses'])->name('admin.houses');
Route::delete('/admin/house/{id}', [devController::class, 'deleteHouse'])->name('admin.house.delete');
Route::get('/admin/rooms', [devController::class, 'showRooms'])->name('admin.rooms');
Route::delete('/admin/room/{id}', [devController::class, 'deleteRoom'])->name('admin.room.delete');






Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
