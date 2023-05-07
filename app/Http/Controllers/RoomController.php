<?php

namespace App\Http\Controllers;

use App\Events\NotificationCreated;
use App\Models\Hospital;
use App\Models\Notification;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $code)
    {
        $request->validate([
            'name' => ['required']
        ]);

        $hospital = Hospital::where(['code' => $code])->first();

        $details = [
            'total_beds' => $request->total_beds,
            'vacant_beds' => $request->vacant_beds,

        ];
        $room = Room::create([
            'hospital_id' => $hospital->id,
            'name' => $request->name,
            'details' => $details
        ]);

        $admins = User::where(function ($query) {
            $query->where('role', 'admin')->orWhere('role', 'staff');
        })->whereNot('id', Auth::id())->get();

        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'expired_at' => Carbon::now()->addDays(30),
                'details' => [
                    'title' => 'Room Created',
                    'method' => 'Add',
                    'content' => Auth::user()->name .' created room '. $room->name .' for '. $hospital->name
                ]
            ]);
        }

        broadcast(new NotificationCreated())->toOthers();

        return Redirect::back()->with('success', 'Room Created')->with('active_nav', 'nav-rooms');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit($code, $id)
    {
        $hospital = Hospital::where(['code' => $code])->first();

        $room = Room::find($id);
        return view('bed-tracker.edit-room', ['room' => $room, 'hospital' => $hospital]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $code,$id)
    {
        $room = Room::find($id);
        $hospital = Hospital::find($room->hospital_id);
        $details = [
            'total_beds' => $request->total_beds,
            'vacant_beds' => $request->vacant_beds,
        ];

        $room->update([
            'name' => $request->name,
            'details' => $details
        ]);

        $admins = User::where(function ($query) {
            $query->where('role', 'admin')->orWhere('role', 'staff');
        })->whereNot('id', Auth::id())->get();

        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'expired_at' => Carbon::now()->addDays(30),
                'details' => [
                    'title' => 'Room Updated',
                    'method' => 'Update',
                    'content' => Auth::user()->name .' updated room '. $room->name .' from hospital '. $hospital->name
                ]
            ]);
        }

        broadcast(new NotificationCreated())->toOthers();
        
        return Redirect::back()->with('success', 'Room updated!')->with('active_nav', 'nav-rooms');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy($code, $id)
    {
        $hospital = Hospital::where(['code' => $code])->first();
        $room = Room::find($id);

        $admins = User::where(function ($query) {
            $query->where('role', 'admin')->orWhere('role', 'staff');
        })->whereNot('id', Auth::id())->get();

        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'expired_at' => Carbon::now()->addDays(30),
                'details' => [
                    'title' => 'Room Deleted',
                    'method' => 'Delete',
                    'content' => Auth::user()->name .' deleted room '. $room->name .' from '. $hospital->name
                ]
            ]);
        }
        
        $room->delete();

        broadcast(new NotificationCreated())->toOthers();

        return Redirect::back()->with('success', 'Room Deleted!')->with('active_nav', 'nav-rooms');
    }
}
