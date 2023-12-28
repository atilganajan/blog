<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeRequest;
use App\Models\Subscription;

class SubscribeController extends Controller
{
    public function subscribe(SubscribeRequest $request)
    {
        try {
            Subscription::create($request->only("subscribe_email"));
            return redirect()->route("home")->with(["success" => "success"]);
        } catch (\Exception $err) {
            return view("error.500");
        }
    }
}
