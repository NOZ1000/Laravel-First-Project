<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function edit(Request $request) 
    {
        return view('profiles.edit')->with([
            'user' => $request->user(),
        ]);
    }
    public function update(ProfileRequest $request) 
    {
        $user = $request->user();


        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
            $user->sendEmailVerificationNotification();
        }

        

        $user->save();

        return redirect()
            ->route('profile.edit')
            ->withSuccess('Profile edited successfully');
    }
}
