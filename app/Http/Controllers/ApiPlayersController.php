<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class ApiPlayersController extends Controller
{

public function addNewPlayerViaGoogle(Request $request)
{
    if ($request->key != env('API_SECRET_KEY')) {
        return response()->json(['success' => 'api_error']);
    }

    $player = Player::where('email', $request->email)->first();

    if (!$player) {
        $player = Player::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make(Str::random(8)),
            'device_id' => $request->device,
            'image_url' => $request->image,
            'api_token' => Str::random(60),
        ]);
    }

    // 🔥 أهم سطر (الحل)
    if (!$player->api_token) {
        $player->api_token = Str::random(60);
        $player->save();
    }

    return response()->json([
        'success' => 'done',
        'token' => $player->api_token,
    ]);
}
}
