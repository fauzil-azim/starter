<?php

namespace App\Observers;

use App\Models\User;
use Ramsey\Uuid\Uuid as Generator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image;
use Ramsey\Uuid\Exception\UnableToBuildUuidException;

class UserObserver
{

    public function creating($model) {
        try {
            $model->uuid = Generator::uuid4()->toString();
        } catch (UnableToBuildUuidException $e) {
            abort(500, $e->getMessage());
        }

        $model->password = Hash::make($model->password);

        if( request()->hasFile('profile_picture') ) {
            $file = request()->file('profile_picture');
            $filename = time() . $file->getClientOriginalName();
            $file->storeAs('/public/profile_pictures', $filename);
            $model->profile_picture = URL::asset('storage/profile_pictures/' . $filename);
        } else {
            $model->profile_picture = url('images/No_Image_Available.jpg');
        }

        /* Image resize 
        * Note : Image resize can't store image to not yet existing folder
        */
        // if( request()->hasFile('profile_picture') ) {
        //     $file = request()->file('profile_picture');
        //     $filename = time() . $file->getClientOriginalName();
        //     $destinationpath = public_path('/storage/profile_pictures') . '/' . $filename;
        //     $image = Image::make($file->path());
        //     $image->resize(200, 200, function($constraint) {
        //         $constraint->aspectRatio();
        //     })->save($destinationpath);
        //     $model->profile_picture = url('storage/' . $filename);
        // } else {
        //     $model->profile_picture = url('images/No_Image_Available.jpg');
        // }

    }


    /* this model event only get fire if there is a different with the value in database */
  
    public function updated(User $user) {
        if($user->isDirty('email')) {
            if( !is_null($user->email_verified_at) ) {
                $user->unverify();
            }
            $user->sendEmailVerificationNotification();
        }
        if($user->isDirty('password')) {
            $user->encrypted()->update(['encrypted_password' => Crypt::encrypt(request()->input('password'))]);
        }
    } 
}
