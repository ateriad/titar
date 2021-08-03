<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        return view('pages.front.contact');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'max:64'],
            'email' => ['required', 'max:64', 'email'],
            'content' => ['required'],
        ]);

        $cm = new ContactMessage();
        $cm->name = $request->input('name');
        $cm->email = $request->input('email');
        $cm->content = $request->input('content');
        $cm->save();

        return back()->with('success', trans('words.contact_sent'));
    }
}
