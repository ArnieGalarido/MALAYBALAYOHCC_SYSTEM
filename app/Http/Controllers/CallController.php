<?php

namespace App\Http\Controllers;

use App\Events\NotificationCreated;
use App\Models\Call;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        $sort = $request->sort ?? 'asc';

        $calls = Call::when($search, function($query, $search) {
            $query->where('type', 'like', "%{$search}%");
        })->orderBY('called_at', $sort)->paginate(10);

        $counted = [
            'admitted' => Call::where('type', 'admitted')->count(),
            'followup' => Call::where('type', 'followup')->count(),
            'cancelled' => Call::where('type', 'cancelled')->count(),
            'expires' => Call::where('type', 'expires')->count(),
            'pending' => Call::where('type', 'pending')->count()
        ];

        return view('calls.call-list', ['calls' => $calls, 'counted' => $counted, 'search' => $search]);
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
    public function store(Request $request)
    {
        $details = [];
        $call = Call::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'details' => $details,
            'called_at' => $request->called_at,
        ]);

        $admins = User::where(function ($query) {
            $query->where('role', 'admin')->orWhere('role', 'staff');
        })->whereNot('id', Auth::id())->get();

        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'expired_at' => Carbon::now()->addDays(30),
                'details' => [
                    'title' => 'Call Created',
                    'method' => 'Add',
                    'content' => Auth::user()->name .' added a call at '. $call->called_at
                ]
            ]);
        }
        broadcast(new NotificationCreated())->toOthers();

        return Redirect::back()->with('success', 'Call added');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Call  $call
     * @return \Illuminate\Http\Response
     */
    public function show(Call $call)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Call  $call
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $call = Call::find($id);
        return view('calls.edit-call', ['call' => $call]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Call  $call
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $call = Call::find($id);
        $details = [];
        $call->update([
            'type' => $request->type,
            'details' => $details,
            'called_at' => $request->called_at,
        ]);

        $admins = User::where(function ($query) {
            $query->where('role', 'admin')->orWhere('role', 'staff');
        })->whereNot('id', Auth::id())->get();

        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'expired_at' => Carbon::now()->addDays(30),
                'details' => [
                    'title' => 'Call Updated',
                    'method' => 'Update',
                    'content' => Auth::user()->name .' updated a call at '. $call->called_at
                ]
            ]);
        }
        
        broadcast(new NotificationCreated())->toOthers();

        return Redirect::back()->with('success', 'Call updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Call  $call
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $call = Call::find($id);

        $admins = User::where(function ($query) {
            $query->where('role', 'admin')->orWhere('role', 'staff');
        })->whereNot('id', Auth::id())->get();

        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'expired_at' => Carbon::now()->addDays(30),
                'details' => [
                    'title' => 'Call Deleted',
                    'method' => 'Delete',
                    'content' => Auth::user()->name .' deleted a call at '. $call->called_at
                ]
            ]);
        }

        $call->delete();

        broadcast(new NotificationCreated())->toOthers();
        
        return Redirect::back()->with('success', 'Call deleted');
    }
}
