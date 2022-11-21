<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewMail;
use App\Models\Garage;
use App\Models\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function sendMessage(Request $request) {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'text' => 'required',
            'garage_id' => 'required|numeric'
        ]);

        $data = $request->all();
        
        $message = new Message();

        $message->fill($data);
        $message->save();

        $garage = Garage::find($message->garage_id);

        $user = User::find($garage->user_id);

        Mail::to($user->email)->send(new NewMail($message));

        return response()->json([
            'success' => true
        ]);
    }
}
