<?php

namespace App\Http\Controllers\Public;

use App\Events\Hello;
use App\Http\Controllers\Controller;
use App\Mail\SubscribeMail;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class SubscribeController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        Subscriber::create(['email' => $request->get('email')]);

        Mail::to($request->get('email'))
            ->send(new SubscribeMail());

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return void
     */
    public function unsubscribe(Request $request)
    {

    }
}
