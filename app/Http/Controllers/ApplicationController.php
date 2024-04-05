<?php

namespace App\Http\Controllers;

use App\Mail\ApplicationCreated;
use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class ApplicationController extends Controller
{


    public function store(Request $request)
    {
        if ($request->hasFile('file')) {

            $name = $request->file('file')->getClientOriginalName();


            $path = $request->file('file')->storeAs('public/file', $name);
        }

        $request->validate([
            'subject' => 'required|max:255',
            'message' => 'required',
            'file' => 'file|mimes:jpeg,png,jpg,gif',
        ]);

        $application = Application::create([
            'user_id' => auth()->user()->id,
            'subject' => $request->subject,
            'message' => $request->message,
            'file_url' => $path ?? null,
        ]);




        $manager = User::first();

        Mail::to($manager)->send(new ApplicationCreated($application));

        //Mail::to($request->user())->send(new ApplicationCreated($application));


        return redirect()->back();
    }
}
