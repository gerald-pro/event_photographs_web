<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile_photo;
use App\Models\Number_contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user->profile_photo_url = Cloudinary::getUrl($user->profilePhotos->first()->photo_path);
        return view('profile.index', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $passwordHashed = $user->password;
        $password = $request->password;
        if (Hash::check($password, $passwordHashed)) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->newpassword);
            $profile_photo = Profile_photo::where('user_id', $user->id)->first();
            $number_contact = Number_contact::where('user_id', $user->id)->first();
            $number_contact->number = $request->telephone;
            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                Cloudinary::destroy($profile_photo->photo_path);
                $fotoCloud = Cloudinary::upload($imagen->getRealPath(), ['folder' => 'users']);
                $publicId = $fotoCloud->getPublicId();
                $profile_photo->photo_path = $publicId;
                $profile_photo->save();
            }
            $user->save();
            $number_contact->save();
            return redirect()->to('/home');
        } else {
            $mensaje = 'contraseña incorrecta';
            return view('profile.index', compact('user', 'mensaje'));
        }
    }
}
