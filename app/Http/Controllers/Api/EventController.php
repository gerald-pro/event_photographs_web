<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\UserEventAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $events = [];
        foreach ($user->guestEvents as $event) {
            $events[] = [
                'id' => $event->id,
                'name' => $event->name,
                'detail' => $event->detail,
                'address' => $event->address,
                'token' => UserEventAccess::all()->where('event_id', $event->id)->where('user_id', $user->id)->first()->token,
                'start_date' => $event->start_date,
                'start_time' => $event->start_time,
                'privacity' => $event->privacity = 0 ? 'Público' : ($event->privacity = 1 ? 'Privado' : 'Solo yo'),
                'planner' => $event->planner->name,
                'created_at' => $event->created_at,
                'updated_at' => $event->updated_at,
            ];
        }
        return $events;
    }

    /**
     *
     */
    public function pictures(Event $event)
    {
        $user = Auth::user();
        if ($event->privacity == 2) {
            $pictures = $user->picturesWhereIAppear->where('event_id', $event->id)->values()->toArray();
        } else {
            $pictures = $event->pictures->values()->toArray();
        }

        return $pictures;
    }

    /**
     *
     */
    public function myPictures()
    {
        try {
            $user = Auth::user();
            $pictures = $user->purchasedPictures->values()->toArray();
            //return ['status' => 'success', 'pictures' => $pictures];
            return $pictures;
        } catch (\Throwable $th) {
            return response(['status' => 'error', 'pictures' => [], 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $user = Auth::user();
        $response = [
            'id' => $event->id,
            'name' => $event->name,
            'detail' => $event->detail,
            'address' => $event->address,
            'key_event' => $event->key_event,
            'token' => UserEventAccess::all()->where('event_id', $event->id)->where('user_id', $user->id)->first()->token,
            'start_date' => $event->start_date,
            'start_time' => $event->start_time,
            'privacity' => $event->privacity == 0 ? 'Público' : ($event->privacity == 1 ? 'Privado' : 'Solo fotos donde aparezco'),
            'planner' => $event->planner->name,
            'created_at' => $event->created_at,
            'updated_at' => $event->updated_at,
        ];
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
