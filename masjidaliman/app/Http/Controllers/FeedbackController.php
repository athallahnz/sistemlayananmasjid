<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message');

        // Nomor WhatsApp Admin
        $adminPhone = '6285369369517'; // Ganti dengan nomor WhatsApp admin Anda

        // Format pesan yang akan dikirim ke WhatsApp
        $whatsappMessage = "Nama: $name\nEmail: $email\nPesan: $message";

        // Encode URL untuk WhatsApp
        $whatsappUrl = "https://wa.me/$adminPhone?text=" . urlencode($whatsappMessage);

        // Redirect ke URL WhatsApp
        return redirect()->away($whatsappUrl);
    }
}
