<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function send(Request $request)
    {

        $user = Auth::guard('admin')->user();

        $message = Message::create([
            'from_id'   => $user->id,
            'to_id'     => $request->to_id,
            'message'   => $request->message,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'status' => 'sent'
        ]);
    }
}
