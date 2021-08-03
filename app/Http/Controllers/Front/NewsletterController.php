<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends  Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email', 'unique:newsletters', 'max:64'],
        ]);

        $nl = new Newsletter();
        $nl->email = $request->input('email');
        $nl->save();

        return back()->with('success', trans('words.newsletter_subscribed'));

    }
}
