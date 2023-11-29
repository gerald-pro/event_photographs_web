<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Services\RekognitionService;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function gallery(Event $event)
    {
        $user = Auth::user();
        $pictures = Picture::where('user_id', $user->id)
            ->where('event_id', $event->id)->get();
        foreach ($pictures as &$picture) {
            $url = Cloudinary::getUrl($picture->photo_path);
            $picture->url = $url;
        }
        return view('event.gallery_pictures', compact('pictures', 'event'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function upload(Event $event)
    {
        return view('event.upload_pictures', compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Event $event)
    {
        $user = Auth::user();

        $imagen = $request->file('file');

        $rkService = new RekognitionService();
        $faces = $rkService->searchFaceUsersByImage($imagen->get());

        $fotoCloud = Cloudinary::upload($imagen->getRealPath(), ['folder' => 'events']);

        $publicId = $fotoCloud->getPublicId();
        $imageName = time() . '.' . $imagen->extension();
        $picture = Picture::create([
            'name' => $imageName,
            'photo_path' => $publicId,
            'price' => $request['price'] ? $request['price'] : 5.00,
            'event_id' => $event->id,
            'user_id' => $user->id
        ]);

        if ($faces['Status'] == 'success') {
            $rkService->relateFaceUsersToPicture($faces['FaceIds'], $picture);
        }
        return response()->json(['success' => $imageName]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Picture $picture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Picture $picture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Picture $picture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event, Picture $picture)
    {
        Cloudinary::destroy($picture->photo_path);
        $picture->delete();
        return redirect()->route('event.gallery.index', $event);
    }
}
