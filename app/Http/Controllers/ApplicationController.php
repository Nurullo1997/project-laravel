<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {

        // Faylni tekshirish
        if ($request->hasFile('file')) {
            // Fayl nomini olish
            $fileName = $request->file('file')->getClientOriginalName();
            
            // Faylni diskka saqlash
            $path = $request->file('file')->storeAs('public/files', $fileName);
        } else {
            // Fayl yuborilmaganligi haqida xabar
            $path= null;
        }

        // Faylni validatsiya qilish
        $request->validate([
            'subject' => 'required|string|max:255', // Subject ning maksimal uzunligi 255 belgi
            'message' => 'required|string', // Message ning majburiy bo'lishi
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048', // Fayl formati, maksimum hajmi
        ]);

        // Faylni bazaga saqlash
        $application = Application::create([
            'user_id' => auth()->user()->id,
            'subject' => $request->subject,
            'message' => $request->message,
            'file_url' => $path,
        ]);

        // Faylni bazaga saqlash muvaffaqiyatli bo'lganini xabar berish
        return redirect()->back()->with('success', 'Ariza muvaffaqiyatli saqlandi!');
    }
}
