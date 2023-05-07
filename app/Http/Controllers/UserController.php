<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        $sort = $request->sort ?? 'asc';

        $users = User::when($search, function($query, $search) {
            $query->where('name', 'like', "%{$search}%");
        })->orderBY('name', $sort)->paginate(10);

        return view('users.user-list', ['users' => $users, 'search' => $search]);
    }
    public function show($code)
    {
     
        $user = User::where(['code' => $code])->first();
        $hospitals = Hospital::all();
        return view('users.user-show', ['user' => $user, 'hospitals' => $hospitals]);
    }

    public function register()
    {
        $hospitals = Hospital::all();
        return view('users.register', ['hospitals' => $hospitals]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => ['required'],
            'role' => ['required'],
            'email' => ['required', 'max:255'],
            'password' => ['required', 'min:6', 'max:255']
        ]);

        if ($request->role == 'user' && $request->hospital == null) {
            return redirect()->back()->withErrors('Hospital is required for hospital users.');
        }

        $details = [
            'firstname' => $request->firstname, 
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'suffix' => $request->suffix,
            'birthday' => $request->birthday,
            'age' => Carbon::parse($request->birthday)->age,
            'gender' => $request->gender,
            'contact_number' => $request->contact_number,
            'address' => $request->address,
            'zipcode' => $request->zipcode,
        ];
    
        $user = User::create([
            'code' => Str::random(10),
            'name' => $details['firstname'].' '.$details['middlename'].' '.$details['lastname'].''.$details['suffix'],
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'role' => $request->role,
            'details' => $details
        ]);

        if ($request->hospital != null && $user->role == 'user') {
            $hospital = Hospital::where(['code' => $request->hospital])->first();
            $user->hospital_id = $hospital->id;
            $user->save();
        }

        return redirect()->back()->with('success', 'User has been created!');
    }

    public function destroy($code)
    {
        $user = User::where(['code' => $code])->first();
        $user->delete();

        return Redirect::back()->with('success', 'User Deleted');
    }

    public function login() {
        if (Auth::check()) {
            return redirect(route('reports.index'));
        }
        return view('users.login');
    }

    public function authenticate(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            if (Auth::user()->role == 'user') {
                $hospital = Hospital::find(Auth::user()->hospital_id);
                return redirect(route('bed-tracker.show', ['code' => $hospital->code]));
            } else {
                return redirect(route('reports.index'));
            }
        } else {
            return redirect()->back()->withErrors(['email' => "We couldn't find an account that matches what you entered"]);
        }
    }

    public function logout(Request $request) {
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect(route('login'));
    }

    public function profile() {
        $user = Auth::user();
        return view('users.profile', ['user' => $user]);
    }

    public function edit_profile() {
        $user = Auth::user();
        return view('users.profile', ['user' => $user]);
    }

    public function update_profile(Request $request) {
        $request->validate([
            'firstname' => ['required'],
            'email' => ['required', 'max:255']
        ]);

        $user = User::where(['id' => Auth::id()])->first();

        $details['firstname'] = $request->firstname;
        $details['middlename'] = $request->middlename;
        $details['lastname'] = $request->lastname;
        $details['suffix'] = $request->suffix;
        $details['birthday'] = $request->birthday;
        $details['age'] = Carbon::parse($request->birthday)->age;
        $details['gender'] = $request->gender;
        $details['contact_number'] = $request->contact_number;
        $details['address'] = $request->address;
        $details['zipcode'] = $request->zipcode;

        $user->update([
            'name' => $details['firstname'].' '.$details['middlename'].' '.$details['lastname'].''.$details['suffix'],
            'email' => $request->email,
            'details' => $details
        ]);

        /* $user->update([
            'name' => ($request->firstname ?? '').' '.($request->middlename ?? '').' '.($request->lastname ?? '').' '.($request->suffix ?? ''),
            'email' => $request->email,
            'details->firstname' => $request->firstname,
            'details->middlename' => $request->middlename,
            'details->lastname' => $request->lastname,
            'details->suffix' => $request->suffix,
            'details->borthday' => $request->birthday,
            'details->age' => $request->age,
            'details->gender' => $request->gender,
            'details->contact_number' => $request->contact_number,
            'details->address' => $request->address,
            'details->zipcode' => $request->zipcode,
        ]); */

        if ($request->password != null || $request->password != '') {
            if (Hash::make($request->old_password) == Hash::make($request->password)) {
                $user->password = Hash::make($request->password);
                $user->save();
            } else {
                return redirect()->back()->with('warning', "Old password did not match");
            }
        }

        return Redirect::back()->with('success', 'Profile updated');
    }
}
