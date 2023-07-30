<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Notifications\UserNotification;

class ContactController extends Controller
{
    public function create()
    {
        return view('project.contact');
    }

    public function contact()
    {
        $data = request()->validate([
            'name'    => 'required|max:25', 'email' => 'required|email',
            'message' => 'required|max:255',
        ]);

        Mail::to('mahmoudramadan496@gmail.com')->send(new \App\Mail\ContactUs);

        if (Mail::failures()) {
            return redirect()->back()->with('error', 'mail can\'t send');
        } else {
            session()->flash(
                'message',
                'message sent successfully, we will keep in touch as soon as'
            );
            $this->notifyUser($data);

            return back();
        }
    }

    public function notifyUser($data)
    {
        Auth::user()->notify(new UserNotification($data));
    }
}
