<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewMail;
use App\Models\Garage;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function sendMessage(Request $request) {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'text' => 'required'
        ]);
        
        $data = $request->all();

        $message = new Message();

        //$message->garage_id = 

        $message->fill($data);
        $message->save();

        Mail::to('verapersona@sicuro.it')->send(new NewMail($message));

        return response()->json([
            'success' => true
        ]);
    }
}
