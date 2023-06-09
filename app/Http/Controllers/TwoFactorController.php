<?php

namespace App\Http\Controllers;

use App\AuthReq as AppAuthReq;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

use App\Models\User;
use App\Models\AuthReq;

class TwoFactorController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function auth(Request $request)
    {
        if(empty(Auth::user()->secret)) {
            return Redirect::route('2fa.secret');
        }
        if(!empty(Auth::user()->auth) && now() < Auth::user()->auth) {
            return Redirect::route('dashboard');
        }

        $auth = AuthReq::where('user_id', Auth::user()->id)->first();
        if(isset($auth) && $auth->valid_until < now()) {
            AuthReq::where('user_id', Auth::user()->id)->delete();
            AuthReq::create([
                'user_id' => Auth::user()->id,
                'valid_until' => now()->addMinutes(10),
            ]);
        }
        if(!isset($auth)) {
            AuthReq::where('user_id', Auth::user()->id)->delete();
            AuthReq::create([
                'user_id' => Auth::user()->id,
                'valid_until' => now()->addMinutes(10),
            ]);
        }

        return view('twofactor.auth');
    }

    public function secret(Request $request)
    {
        if(!empty(Auth::user()->secret)) {
            return Redirect::route('dashboard');
        }
        $secret = bin2hex(openssl_random_pseudo_bytes(4));
        return view('twofactor.secret', [
            'secret' => $secret,
        ]);
    }

    public function secret_save(Request $request)
    {
        $validate = $request->validate([
            'secret' => ['required'],
        ]);
        $user = User::findOrFail(Auth::user()->id);
        $user->secret = Hash::make($validate['secret']);
        $user->save();
        return Redirect::route('2fa.auth');
    }

    public function authReq(Request $request)
    {
        $all = $request->all();
        if(empty($all['secret']) || empty($all['user_id'])) {
            return response()->json([
                'secret' => $all['secret']??'null',
                'user_id' => $all['user_id']??'null',
            ], 422);
        } else {
            $user = User::findOrFail($all['user_id']);
            if(Hash::check($all['secret'], $user->secret)) {
                $auth = AuthReq::where('user_id', $all['user_id'])->first();
                if(empty($auth)) return response()->json(['request' => false], 200);
                if($auth->valid_until < now()) {
                    // dd($auth);
                    $auth->delete();
                } else {
                    return response()->json(['request' => true], 200);
                }
                return response()->json(['request' => false], 200);
            } else {
                return response()->json(['Access denied'], 403);
            }
        }
    }

    public function authCheck(Request $request)
    {
        $all = $request->all();
        if(empty($all['secret']) || empty($all['user_id']) || empty($all['response'])) {
            return response()->json([
                'secret' => $all['secret']??'null',
                'user_id' => $all['user_id']??'null',
                'response' => $all['response']??'null',
            ], 422);
        } else {
            $user = User::findOrFail($all['user_id']);
            if(Hash::check($all['secret'], $user->secret)) {
                $auth = AuthReq::where('user_id', $all['user_id'])->first();
                if(empty($auth)) return response()->json(['request' => false], 422);
                if($auth->valid_until < now()) {
                    // dd($auth);
                    $auth->delete();
                } else if($all['response'] == "true") {
                    $auth->delete();
                    $user->auth = now()->addMinutes(2);
                    $user->save();
                    return response()->json(['accepted' => true], 200);
                }
            } else {
                return response()->json(['Access denied'], 403);
            }
        }
    }

    public function check(Request $request, $id)
    {
        $user = User::find($id);
        if($user && !empty($user->auth) && now() < $user->auth) {
            return response()->json(['redirect' => route('dashboard')]);
        } else {
            return response()->json([]);
        }
    }
}
