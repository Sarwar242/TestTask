<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Subscriber;
use App\Models\Website;

class SubscriberController extends Controller
{
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|string',
            'website_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $website=Website::find($request->website_id);
        if($website->subscribers()->where('email', $request->email)->exists()){
            return response()->json([
                "success"  => false,
                "message" => "Already subscribed!",
            ], 401);
        }

        $subscribe = new Subscriber;
        $subscribe->name= $request->name;
        $subscribe->email= $request->email;
        $subscribe->website_id= $request->website_id;
        $subscribe->save();
        return response()->json([
            "success"  => true,
            "message" => "Subscribed successfully.",
            'subscribe' => $subscribe
        ], 200);

    }
}
