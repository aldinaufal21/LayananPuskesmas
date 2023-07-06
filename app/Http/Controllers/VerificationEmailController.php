<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class VerificationEmailController extends Controller
{
    public function verify($id, Request $request)
    {
        if (!$request->hasValidSignature()) {
            return $this->respondUnAuthorizedRequest(253);
        }

        $user = User::findOrFail($id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return redirect()->to('/login')->with('alert-success', 'berhasil verifikasi email!');
    }

    public function resend($email)
    {
        $user = User::where('email', $email)->first();

        if (empty($user)) {
            return response()->json([
                'status' => 404,
                'description' => 'account not found!'
            ]);
        }
        else {
            if ($user->hasVerifiedEmail()) {
                return response()->json([
                    'status' => 254,
                    'description' => 'account has verified!'
                ]);
            }
    
            $user->sendEmailVerificationNotification();
    
            return response()->json([
                'status' => 200,
                'description' => 'Email verification link sent on your email id'
            ]);
        }
    }
}
