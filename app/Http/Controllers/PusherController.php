<?php

namespace App\Http\Controllers;

use App\Events\PusherEvent;
use Illuminate\Http\Request;

class PusherController extends Controller
{
    public function index()
    {
        return view('sample');
    }

    public function kirim(Request $request)
    {
        broadcast(new PusherEvent($request->message));

        return response()->json([
            'code' => 200,
            'message' => "OK",
        ]);
    }
}
