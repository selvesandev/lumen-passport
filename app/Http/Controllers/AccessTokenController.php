<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AccessTokenController extends Controller
{
    public function createAccessToken(Request $request)
    {
        $inputs = $request->all();

        $user = null;
        if (isset($inputs['username']) && $inputs['grant_type'] == 'password') {
            $user = User::where(['email' => $inputs['username']])->first();
        }

//        if ($user instanceof User) {
//            // user with basic role can only request for basic scope
//            if ($user->role === User::BASIC_ROLE) {
//                $inputs['scope'] = 'basic';
//            }
//        } else {
//            // client_credentials grant can only request for basic scope
//            $inputs['scope'] = 'basic';
//        }

        $tokenRequest = $request->create('/oauth/token', 'post', $inputs);

        // forward the request to the oauth token request endpoint
        return app()->dispatch($tokenRequest);
    }
}