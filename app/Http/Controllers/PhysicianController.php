<?php

namespace App\Http\Controllers;

use App\Events\NotificationCreated;

use App\Models\Hospital;
use App\Models\Physician;
use App\Models\Notification;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Carbon\Carbon;

class PhysicianController extends Controller
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
            'specialty' => $request->specialty,
        ];

        $physician = Physician::create([
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
                    'title' => 'Physcian Added',
                    'method' => 'Add',
                    'content' => Auth::user()->name .' added physician '. $physician->name .' for '. $hospital->name
                ]
            ]);
        }

        broadcast(new NotificationCreated())->toOthers();

        return Redirect::back()->with('success', 'Physician Added')->with('active_nav', 'nav-physicians');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Physician  $physician
     * @return \Illuminate\Http\Response
     */
    public function show(Physician $physician)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Physician  $physician
     * @return \Illuminate\Http\Response
     */
    public function edit(Physician $physician)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Physician  $physician
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $code, $id)
    {
        $physician = Physician::find($id);
        $hospital = Hospital::find($physician->hospital_id);

        $details = [
            'specialty' => $request->specialty,
        ];

        $physician->update([
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
                    'title' => 'Physician Updated',
                    'method' => 'Update',
                    'content' => Auth::user()->name .' updated physician '. $physician->name .' from hospital '. $hospital->name
                ]
            ]);
        }

        broadcast(new NotificationCreated())->toOthers();
        
        return Redirect::back()->with('success', 'Physician updated!')->with('active_nav', 'nav-physicians');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Physician  $physician
     * @return \Illuminate\Http\Response
     */
    public function destroy($code, $id)
    {
        $hospital = Hospital::where(['code' => $code])->first();
        $physician = Physician::find($id);

        $admins = User::where(function ($query) {
            $query->where('role', 'admin')->orWhere('role', 'staff');
        })->whereNot('id', Auth::id())->get();

        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'expired_at' => Carbon::now()->addDays(30),
                'details' => [
                    'title' => 'Physician Removed',
                    'method' => 'Delete',
                    'content' => Auth::user()->name .' removed physician '. $physician->name .' from '. $hospital->name
                ]
            ]);
        }
        
        $physician->delete();

        broadcast(new NotificationCreated())->toOthers();
        
        return Redirect::back()->with('success', 'Physician Removed!')->with('active_nav', 'nav-physicians');
    }
}
