<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index() 
    {
        $user = User::findOrFail(Auth::id());
        
        if( request()->wantsJson() ) {
            return response()->json($user);
        }
        return view('user.profile', compact('user'));
    }

    public function update(Request $request) {
        
        $user = User::where('uuid', $request->uuid)->firstOrFail();
        
        $validatedData = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)], 
            'password' => ['nullable', 'string', 'min:8'], 
        ]);

        foreach(array_filter($validatedData) as $key => $value) {
            if($key == 'password') {
                $user->password = Hash::make($value);
            } else {
                $user->{$key} = $value;
            }
        }
        $user->save();

        return response()->json($user);
    }

    public function changeProfilePicture(Request $request) 
    {
        $user = User::where('uuid', $request->uuid)->firstOrFail();

        if($request->file('profile_picture')->isValid()) {
            $path = explode('/', $user->profile_picture);
            if(end($path) != 'No_Image_Available.jpg') {
                unlink(public_path('storage/profile_pictures') . '/' . end($path));
            }
            $file = $request->file('profile_picture');
            $filename = time() . $file->getClientOriginalName();
            $file->storeAs('/public/profile_pictures', $filename);
            $user->profile_picture = URL::asset('storage/profile_pictures/' . $filename);
            $user->save();            
        }
        return back();

    }

}
