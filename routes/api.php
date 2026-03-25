<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiPlayersController;

Route::post('/players/google/add', [ApiPlayersController::class, 'addNewPlayerViaGoogle']);
Route::post('/player/profile', [ApiPlayersController::class, 'getProfile']);