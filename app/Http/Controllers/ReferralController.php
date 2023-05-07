<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Referral;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class ReferralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        $status = $request->status ?? null;

        $referrals = Referral::with('user')->with('patient')->with('referring_hospital')->with('referred_hospital')->when($search, function($query, $search) {
            $query->where('details->patient_name', 'like', "%{$search}%");
        })->when($status, function($query, $status) {
            $query->where('details->call_status', $status);
        })->paginate(10);
        
        $hospitals = Hospital::all();
        return view('referrals.referral-list', ['referrals' => $referrals, 'hospitals' => $hospitals, 'search' => $search, 'status' => $status]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $referrals = Referral::with('user')->orderBY('id','desc')->get();
        $hospitals = Hospital::with('physicians')->get();

        return view('referrals.add-referral', ['referrals' => $referrals, 'hospitals' => $hospitals]);
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
            // 'referring_hospital' => ['required'],
            'referred_hospital' => ['required'],
            'call_status' => ['required'],
            'birthday' => ['required'],
            'patient_name' => ['required']
        ]);

        $referring_hospital = Hospital::where('code', $request->referring_hospital)->first();
        $referred_hospital = Hospital::where('code', $request->referred_hospital)->first();

        $referral_details = [
            'referral_date' => $request->referral_date,
            'contact_no' => $request->contact_no,
            'referring_physician' => $request->referring_physician,
            'reason_referral' => $request->reason_referral,
            'preferred_doctor' => $request->preferred_doctor,
            'chief_complaints' => $request->chief_complaints,
            'call_received_by' => $request->call_received_by,
            'call_status' => $request->call_status,
            'patient_name' => $request->patient_name,
            'remarks' => $request->remarks,
        ];

        $age = Carbon::parse($request->birthday)->age;

        $patient_datails = [
            'civil_status' => $request->civil_status,
            'birthday' => $request->birthday,
            'age' => $age, //save to record age data upon registering referral
            'sex' => $request->sex,
            'hpi' => $request->hpi,
            'diagnosis' => $request->diagnosis,
            'ra_test' => $request->ra_test,
            'ra_results' => $request->ra_results,
            'ra_date_taken' => $request->ra_date_taken,
            'rtpcr_test' => $request->rtpcr_test,
            'rtpcr_results' => $request->rtpcr_results,
            'rtpcr_date_taken' => $request->rtpcr_date_taken,
            'vaccinated' => $request->vaccinated,
            'vaccine_name' => $request->vaccine_name,
            'booster' => $request->booster,
            'booster_name' => $request->booster_name,
            // vital signs
            'BP' => $request->BP,
            'HR_PR' => $request->HR_PR,
            'RR' => $request->RR,
            'temperature' => $request->temperature,
            'o2sat_room_air' => $request->o2sat_room_air,
            'o2sat_oxygen' => $request->o2sat_oxygen,
            'o2sat_oxygen_litter' => $request->o2sat_oxygen_litter,
            'intubated' => $request->intubated,
            'gcs' => $request->gcs,
            'gcs_e' => $request->gcs_e,
            'gcs_m' => $request->gcs_m,
            'gcs_v' => $request->gcs_v,
            'pertinent_pe' => $request->pertinent_pe,
            'covid_symptoms' => $request->covid_symptoms,
            // ------- trauma
            'incident_place' => $request->incident_place,
            'incident_nature' => $request->incident_nature,
            'incident_time' => $request->incident_time,
            'comorbidities' => $request->comorbidities,
            'maintenance_meds' => $request->maintenance_meds,
            'medication_given' => $request->medication_given,
            'laboratory_results' => $request->laboratory_results,
            // ---ob
            'gravida' => $request->gravida,
            'para' => $request->para,
            'cm_time' => $request->cm_time,
            'aog_via_lmp' => $request->aog_via_lmp,
            'aog_via_utz' => $request->aog_via_utz,
            'edc' => $request->edc,
            'lmp' => $request->lmp,
            'leaking_bow' => $request->leaking_bow,
            'time_started_leaking' => $request->time_started_leaking,
            'FHT' => $request->FHT,
            'FHT_location' => $request->FHT_location,
            'FH' => $request->FH,
            'presentation' => $request->presentation,
            'utz_results' => $request->utz_results,
            'precaution_needed' => $request->precaution_needed
        ];
        
        if (isset($request->gravida) || isset($request->para) || isset($request->cm_time)) { //ob case
            $report_case = 'ob';
        } else if (isset($request->incident_place) || isset($request->incident_nature) || isset($request->incident_time)) { //trauma case
            $report_case = 'trauma';
        } else if ($age >= 17) { //medical case
            $report_case = 'medical';
        } else { //pedia case
            $report_case = 'pedia';
        }
        
        $referral = Referral::create([
            'code' => Str::random(10),
            'referring_id' => $referring_hospital->id ?? null,
            'referred_id' => $referred_hospital->id,
            'user_id' => Auth::id(),
            'details' => $referral_details,
            'referred_at' => $request->referral_date
        ]);
        
        $patient = Patient::create([
            'user_id' => Auth::id(),
            'referral_id' => $referral->id,
            'name' => $request->patient_name,
            'case' => $report_case,
            'status' => $request->call_status,
            'details' => $patient_datails,
            'referred_at' => $request->referral_date
        ]);
        
        return Redirect::back()->with('success', 'Referral created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function show(Referral $referral,$code)
    {
        $referral = Referral::with('patient')->where(['code' => $code])->first();
        $hospitals = Hospital::all();
        return view('referrals.show-referral', ['referral' => $referral, 'hospitals' => $hospitals]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function edit($code)
    {
        $referral = Referral::with('patient')->where(['code' => $code])->first();
        $hospitals = Hospital::all();
        return view('referrals.edit-referral', ['referral' => $referral, 'hospitals' => $hospitals]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $code)
    {

        $request->validate([
            // 'referring_hospital' => ['required'],
            'referred_hospital' => ['required'],
            'call_status' => ['required'],
            'birthday' => ['required']
        ]);

        $referral_details = [
            'referral_date' => $request->referral_date,
            'contact_no' => $request->contact_no,
            'referring_physician' => $request->referring_physician,
            'reason_referral' => $request->reason_referral,
            'preferred_doctor' => $request->preferred_doctor,
            'chief_complaints' => $request->chief_complaints,
            'call_received_by' => $request->call_received_by,
            'call_status' => $request->call_status,
            'patient_name' => $request->patient_name,
            'remarks' => $request->remarks,
        ];

        $age = Carbon::parse($request->birthday)->age;

        $patient_datails = [
            'civil_status' => $request->civil_status,
            'birthday' => $request->birthday,
            'age' => $age, //save to record age data upon registering referral
            'sex' => $request->sex,
            'hpi' => $request->hpi,
            'diagnosis' => $request->diagnosis,
            'ra_test' => $request->ra_test,
            'ra_results' => $request->ra_results,
            'ra_date_taken' => $request->ra_date_taken,
            'rtpcr_test' => $request->rtpcr_test,
            'rtpcr_results' => $request->rtpcr_results,
            'rtpcr_date_taken' => $request->rtpcr_date_taken,
            'vaccinated' => $request->vaccinated,
            'vaccine_name' => $request->vaccine_name,
            'booster' => $request->booster,
            'booster_name' => $request->booster_name,
            // vital signs
            'BP' => $request->BP,
            'HR_PR' => $request->HR_PR,
            'RR' => $request->RR,
            'temperature' => $request->temperature,
            'o2sat_room_air' => $request->o2sat_room_air,
            'o2sat_oxygen' => $request->o2sat_oxygen,
            'o2sat_oxygen_litter' => $request->o2sat_oxygen_litter,
            'intubated' => $request->intubated,
            'gcs' => $request->gcs,
            'gcs_e' => $request->gcs_e,
            'gcs_m' => $request->gcs_m,
            'gcs_v' => $request->gcs_v,
            'pertinent_pe' => $request->pertinent_pe,
            'covid_symptoms' => $request->covid_symptoms,
            // ------- trauma
            'incident_place' => $request->incident_place,
            'incident_nature' => $request->incident_nature,
            'incident_time' => $request->incident_time,
            'comorbidities' => $request->comorbidities,
            'maintenance_meds' => $request->maintenance_meds,
            'medication_given' => $request->medication_given,
            'laboratory_results' => $request->laboratory_results,
            // ---ob
            'gravida' => $request->gravida,
            'para' => $request->para,
            'cm_time' => $request->cm_time,
            'aog_via_lmp' => $request->aog_via_lmp,
            'aog_via_utz' => $request->aog_via_utz,
            'edc' => $request->edc,
            'lmp' => $request->lmp,
            'leaking_bow' => $request->leaking_bow,
            'time_started_leaking' => $request->time_started_leaking,
            'FHT' => $request->FHT,
            'FHT_location' => $request->FHT_location,
            'FH' => $request->FH,
            'presentation' => $request->presentation,
            'utz_results' => $request->utz_results,
            'precaution_needed' => $request->precaution_needed
        ];
        
        if (isset($request->gravida) || isset($request->para) || isset($request->cm_time)) { //ob case
            $report_case = 'ob';
        } else if (isset($request->incident_place) || isset($request->incident_nature) || isset($request->incident_time)) { //trauma case
            $report_case = 'trauma';
        } else if ($age >= 17) { //medical case
            $report_case = 'medical';
        } else { //pedia case
            $report_case = 'pedia';
        }
        
        $referral = Referral::where(['code' => $code])->first();

        
        $referring_hospital = Hospital::where('code', $request->referring_hospital)->first();
        $referred_hospital = Hospital::where('code', $request->referred_hospital)->first();

        $referral->update([
            'referring_id' => $referring_hospital->id ?? null,
            'referred_id' => $referred_hospital->id,
            'details' => $referral_details
        ]);

        $patient = Patient::where(['referral_id' => $referral->id])->first();

        $patient->update([
            'name' => $request->patient_name,
            'case' => $report_case,
            'status' => $request->call_status,
            'details' => $patient_datails
        ]);
        return Redirect::back()->with('success', 'Referral updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function destroy($code)
    {
        $referral = Referral::where(['code' => $code])->first();
        $referral->delete();

        return Redirect::back()->with('success', 'Referral deleted!');
    }
}
