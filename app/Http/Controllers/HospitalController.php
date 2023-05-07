<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Physician;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->role == 'user') {
            $hospital = Hospital::find(Auth::user()->hospital_id);
            return redirect(route('bed-tracker.show', ['code' => $hospital->code]));
        }
        $search = $request->search ?? null;
        $sort = $request->sort ?? 'asc';

        $hospitals = Hospital::when($search, function($query, $search) {
            $query->where('name', 'like', "%{$search}%");
        })->orderBY('name', $sort)->paginate(5);

        return view('bed-tracker.hospital', ['hospitals' => $hospitals, 'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bed-tracker.add-hospital');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'address' => ['required']
        ]);
        $details = [
            'address' => $request->address,
            'main_contact' => $request->main_contact,
            'er_contact' => $request->er_contact,
            'lab_contact' => $request->lab_contact,
            'dialysis_contact' => $request->dialysis_contact,
            'triage_contact' => $request->triage_contact,
        ];
        Hospital::create([
            'code' => Str::random(10),
            'name' => $request->name,
            'details' => $details
        ]);
        return Redirect::back()->with('success', 'Hospital added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $hospital = Hospital::where(['code' => $code])->first();
        $rooms = Room::where(['hospital_id' => $hospital->id])->get();
        $physicians = Physician::where(['hospital_id' => $hospital->id])->get();
        
        $active_nav = session('active_nav');

        return view('bed-tracker.hospital-code', ['hospital' => $hospital, 'rooms' => $rooms, 'physicians' => $physicians, 'active_nav' => $active_nav]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function edit($code)
    {
        $hospital = Hospital::where(['code' => $code])->first();
        return view('bed-tracker.edit-hospital', ['hospital' => $hospital]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $code)
    {
        $request->validate([
            'name' => ['required'],
            'address' => ['required']
        ]);
        $hospital = Hospital::where(['code' => $code])->first();

        $details = [
            'address' => $request->address,
            'main_contact' => $request->main_contact,
            'er_contact' => $request->er_contact,
            'lab_contact' => $request->lab_contact,
            'dialysis_contact' => $request->dialysis_contact,
            'triage_contact' => $request->triage_contact,
        ];
        $hospital->update([
            'name' => $request->name,
            'details' => $details
        ]);
        return Redirect::back()->with('success', 'Hospital updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function destroy($code)
    {
        $hospital = Hospital::where(['code' => $code])->first();

        $hospital->delete();

        return Redirect::back()->with('success', 'Hospital deleted');
    }
}
