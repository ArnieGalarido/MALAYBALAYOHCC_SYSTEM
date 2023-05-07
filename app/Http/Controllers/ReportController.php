<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Models\Patient;
use App\Models\Referral;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request) {
        $date = $request->date ?? null;
        if ($date != null) {
            $data = $this->reports($date);
        } else {
            $data = $this->reports_all($date);
        }
        
        return view('reports.report-list', $data);
        // return view('reports.report-pdf', $data);
    }

    public function generatePDF(Request $request)
    {
        $date = $request->date ?? null;
        if ($date != null) {
            $data = $this->reports($date);
        } else {
            $data = $this->reports_all($date);
        }
            
        $pdf = PDF::loadView('reports.report-pdf', $data);
        $filename = $request->date ?? 'all';
        return $pdf->download('reports_'.$filename.'.pdf');
    }

    public function reports_all($date) {
        $calls = [
            'total' => Call::count() + Patient::count(),
            'admitted' => Call::where('type', 'admitted')->count() + Patient::where('status', 'admitted')->count(),
            'followup' => Call::where('type', 'followup')->count() + Patient::where('status', 'followup')->count(),
            'cancelled' => Call::where('type', 'cancelled')->count() + Patient::where('status', 'cancelled')->count(),
            'expires' => Call::where('type', 'expires')->count() + Patient::where('status', 'expires')->count(),
            'pending' => Call::where('type', 'pending')->count() + Patient::where('status', 'pending')->count()

        ];

        $total = [
            'calls' => $calls['total'],
            'patient' => Referral::where(['referring_id' => null])->count(),
            'referral' => Referral::where('referring_id', '<>', null)->count()
        ];
        
        $trauma_case = [
            'total' => Patient::where(['case' => 'trauma'])->count(),
            'unvaccinated' => [
                'rat_+' => Patient::where(['case' => 'trauma', 'details->vaccinated' => null, ])->where('details->ra_test', 'yes')->count(),
                'rat_-' => Patient::where(['case' => 'trauma', 'details->vaccinated' => null, ])->where('details->ra_test', '<>', 'yes')->count(),
                'ratpcr_+' => Patient::where(['case' => 'trauma', 'details->vaccinated' => null, ])->where('details->rtpcr_test', 'yes')->count(),
                'ratpcr_-' => Patient::where(['case' => 'trauma', 'details->vaccinated' => null, ])->where('details->rtpcr_test', '<>', 'yes')->count()
            ],
            'first_dose' => [
                'rat_+' => Patient::where(['case' => 'trauma', 'details->vaccinated' => 'first_vaccine', ])->where('details->ra_test', 'yes')->count(),
                'rat_-' => Patient::where(['case' => 'trauma', 'details->vaccinated' => 'first_vaccine', ])->where('details->ra_test', '<>', 'yes')->count(),
                'ratpcr_+' => Patient::where(['case' => 'trauma', 'details->vaccinated' => 'first_vaccine', ])->where('details->rtpcr_test', 'yes')->count(),
                'ratpcr_-' => Patient::where(['case' => 'trauma', 'details->vaccinated' => 'first_vaccine', ])->where('details->rtpcr_test', '<>', 'yes')->count()
            ],
            'second_dose' => [
                'rat_+' => Patient::where(['case' => 'trauma', 'details->vaccinated' => 'second_vaccine', ])->where('details->ra_test', 'yes')->count(),
                'rat_-' => Patient::where(['case' => 'trauma', 'details->vaccinated' => 'second_vaccine', ])->where('details->ra_test', '<>', 'yes')->count(),
                'ratpcr_+' => Patient::where(['case' => 'trauma', 'details->vaccinated' => 'second_vaccine', ])->where('details->rtpcr_test', 'yes')->count(),
                'ratpcr_-' => Patient::where(['case' => 'trauma', 'details->vaccinated' => 'second_vaccine', ])->where('details->rtpcr_test', '<>', 'yes')->count()
            ]
        ];
        
        $medical_case = [
            'total' => Patient::where(['case' => 'medical'])->count(),
            'unvaccinated' => [
                'rat_+' => Patient::where(['case' => 'medical', 'details->vaccinated' => null, ])->where('details->ra_test', 'yes')->count(),
                'rat_-' => Patient::where(['case' => 'medical', 'details->vaccinated' => null, ])->where('details->ra_test', '<>', 'yes')->count(),
                'ratpcr_+' => Patient::where(['case' => 'medical', 'details->vaccinated' => null, ])->where('details->rtpcr_test', 'yes')->count(),
                'ratpcr_-' => Patient::where(['case' => 'medical', 'details->vaccinated' => null, ])->where('details->rtpcr_test', '<>', 'yes')->count()
            ],
            'first_dose' => [
                'rat_+' => Patient::where(['case' => 'medical', 'details->vaccinated' => 'first_vaccine', ])->where('details->ra_test', 'yes')->count(),
                'rat_-' => Patient::where(['case' => 'medical', 'details->vaccinated' => 'first_vaccine', ])->where('details->ra_test', '<>', 'yes')->count(),
                'ratpcr_+' => Patient::where(['case' => 'medical', 'details->vaccinated' => 'first_vaccine', ])->where('details->rtpcr_test', 'yes')->count(),
                'ratpcr_-' => Patient::where(['case' => 'medical', 'details->vaccinated' => 'first_vaccine', ])->where('details->rtpcr_test', '<>', 'yes')->count()
            ],
            'second_dose' => [
                'rat_+' => Patient::where(['case' => 'medical', 'details->vaccinated' => 'second_vaccine', ])->where('details->ra_test', 'yes')->count(),
                'rat_-' => Patient::where(['case' => 'medical', 'details->vaccinated' => 'second_vaccine', ])->where('details->ra_test', '<>', 'yes')->count(),
                'ratpcr_+' => Patient::where(['case' => 'medical', 'details->vaccinated' => 'second_vaccine', ])->where('details->rtpcr_test', 'yes')->count(),
                'ratpcr_-' => Patient::where(['case' => 'medical', 'details->vaccinated' => 'second_vaccine', ])->where('details->rtpcr_test', '<>', 'yes')->count()
            ]
        ];

        $ob_case = [
            'total' => Patient::where(['case' => 'ob'])->count(),
            'unvaccinated' => [
                'rat_+' => Patient::where(['case' => 'ob', 'details->vaccinated' => null, ])->where('details->ra_test', 'yes')->count(),
                'rat_-' => Patient::where(['case' => 'ob', 'details->vaccinated' => null, ])->where('details->ra_test', '<>', 'yes')->count(),
                'ratpcr_+' => Patient::where(['case' => 'ob', 'details->vaccinated' => null, ])->where('details->rtpcr_test', 'yes')->count(),
                'ratpcr_-' => Patient::where(['case' => 'ob', 'details->vaccinated' => null, ])->where('details->rtpcr_test', '<>', 'yes')->count()
            ],
            'first_dose' => [
                'rat_+' => Patient::where(['case' => 'ob', 'details->vaccinated' => 'first_vaccine', ])->where('details->ra_test', 'yes')->count(),
                'rat_-' => Patient::where(['case' => 'ob', 'details->vaccinated' => 'first_vaccine', ])->where('details->ra_test', '<>', 'yes')->count(),
                'ratpcr_+' => Patient::where(['case' => 'ob', 'details->vaccinated' => 'first_vaccine', ])->where('details->rtpcr_test', 'yes')->count(),
                'ratpcr_-' => Patient::where(['case' => 'ob', 'details->vaccinated' => 'first_vaccine', ])->where('details->rtpcr_test', '<>', 'yes')->count()
            ],
            'second_dose' => [
                'rat_+' => Patient::where(['case' => 'ob', 'details->vaccinated' => 'second_vaccine', ])->where('details->ra_test', 'yes')->count(),
                'rat_-' => Patient::where(['case' => 'ob', 'details->vaccinated' => 'second_vaccine', ])->where('details->ra_test', '<>', 'yes')->count(),
                'ratpcr_+' => Patient::where(['case' => 'ob', 'details->vaccinated' => 'second_vaccine', ])->where('details->rtpcr_test', 'yes')->count(),
                'ratpcr_-' => Patient::where(['case' => 'ob', 'details->vaccinated' => 'second_vaccine', ])->where('details->rtpcr_test', '<>', 'yes')->count()
            ]
        ];

        $pedia_case = [
            'total' => Patient::where(['case' => 'pedia'])->count(),
            'unvaccinated' => [
                'rat_+' => Patient::where(['case' => 'pedia', 'details->vaccinated' => null, ])->where('details->ra_test', 'yes')->count(),
                'rat_-' => Patient::where(['case' => 'pedia', 'details->vaccinated' => null, ])->where('details->ra_test', '<>', 'yes')->count(),
                'ratpcr_+' => Patient::where(['case' => 'pedia', 'details->vaccinated' => null, ])->where('details->rtpcr_test', 'yes')->count(),
                'ratpcr_-' => Patient::where(['case' => 'pedia', 'details->vaccinated' => null, ])->where('details->rtpcr_test', '<>', 'yes')->count()
            ],
            'first_dose' => [
                'rat_+' => Patient::where(['case' => 'pedia', 'details->vaccinated' => 'first_vaccine', ])->where('details->ra_test', 'yes')->count(),
                'rat_-' => Patient::where(['case' => 'pedia', 'details->vaccinated' => 'first_vaccine', ])->where('details->ra_test', '<>', 'yes')->count(),
                'ratpcr_+' => Patient::where(['case' => 'pedia', 'details->vaccinated' => 'first_vaccine', ])->where('details->rtpcr_test', 'yes')->count(),
                'ratpcr_-' => Patient::where(['case' => 'pedia', 'details->vaccinated' => 'first_vaccine', ])->where('details->rtpcr_test', '<>', 'yes')->count()
            ],
            'second_dose' => [
                'rat_+' => Patient::where(['case' => 'pedia', 'details->vaccinated' => 'second_vaccine', ])->where('details->ra_test', 'yes')->count(),
                'rat_-' => Patient::where(['case' => 'pedia', 'details->vaccinated' => 'second_vaccine', ])->where('details->ra_test', '<>', 'yes')->count(),
                'ratpcr_+' => Patient::where(['case' => 'pedia', 'details->vaccinated' => 'second_vaccine', ])->where('details->rtpcr_test', 'yes')->count(),
                'ratpcr_-' => Patient::where(['case' => 'pedia', 'details->vaccinated' => 'second_vaccine', ])->where('details->rtpcr_test', '<>', 'yes')->count()
            ]
        ];

        return [
            'total' => $total,
            'calls' => $calls,
            'trauma_case' => $trauma_case,
            'medical_case' => $medical_case,
            'ob_case' => $ob_case,
            'pedia_case' => $pedia_case,
            'date' => $date
        ];
    }

    public function reports($selected_date) {

        $date = $selected_date ?? null;
        if ($selected_date != null) {
            $date = explode('-', $selected_date);
            $year = intval($date[0]);
            $month = intval($date[1]);
        } 
        $calls = [
            'total' => Call::whereYear('called_at', '=', $year)->whereMonth('called_at', '=', $month)->count() + Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->count(),
            'admitted' => Call::whereYear('called_at', '=', $year)->whereMonth('called_at', '=', $month)->where('type', 'admitted')->count() + Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where('status', 'admitted')->count(),
            'followup' => Call::whereYear('called_at', '=', $year)->whereMonth('called_at', '=', $month)->where('type', 'followup')->count() + Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where('status', 'followup')->count(),
            'cancelled' => Call::whereYear('called_at', '=', $year)->whereMonth('called_at', '=', $month)->where('type', 'cancelled')->count() + Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where('status', 'cancelled')->count(),
            'expires' => Call::whereYear('called_at', '=', $year)->whereMonth('called_at', '=', $month)->where('type', 'expires')->count() + Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where('status', 'expires')->count(),
            'pending' => Call::whereYear('called_at', '=', $year)->whereMonth('called_at', '=', $month)->where('type', 'pending')->count() + Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where('status', 'pending')->count()

        ];

        $total = [
            'calls' => $calls['total'],
            'patient' => Referral::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['referring_id' => null])->count(),
            'referral' => Referral::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where('referring_id', '<>', null)->count()
        ];
        
        $trauma_case = [
            'total' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'trauma'])->count(),
            'unvaccinated' => [
                'rat_+' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'trauma', 'details->vaccinated' => null, ])->where('details->ra_test', 'yes')->count(),
                'rat_-' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'trauma', 'details->vaccinated' => null, ])->where('details->ra_test', '<>', 'yes')->count(),
                'ratpcr_+' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'trauma', 'details->vaccinated' => null, ])->where('details->rtpcr_test', 'yes')->count(),
                'ratpcr_-' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'trauma', 'details->vaccinated' => null, ])->where('details->rtpcr_test', '<>', 'yes')->count()
            ],
            'first_dose' => [
                'rat_+' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'trauma', 'details->vaccinated' => 'first_vaccine', ])->where('details->ra_test', 'yes')->count(),
                'rat_-' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'trauma', 'details->vaccinated' => 'first_vaccine', ])->where('details->ra_test', '<>', 'yes')->count(),
                'ratpcr_+' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'trauma', 'details->vaccinated' => 'first_vaccine', ])->where('details->rtpcr_test', 'yes')->count(),
                'ratpcr_-' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'trauma', 'details->vaccinated' => 'first_vaccine', ])->where('details->rtpcr_test', '<>', 'yes')->count()
            ],
            'second_dose' => [
                'rat_+' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'trauma', 'details->vaccinated' => 'second_vaccine', ])->where('details->ra_test', 'yes')->count(),
                'rat_-' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'trauma', 'details->vaccinated' => 'second_vaccine', ])->where('details->ra_test', '<>', 'yes')->count(),
                'ratpcr_+' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'trauma', 'details->vaccinated' => 'second_vaccine', ])->where('details->rtpcr_test', 'yes')->count(),
                'ratpcr_-' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'trauma', 'details->vaccinated' => 'second_vaccine', ])->where('details->rtpcr_test', '<>', 'yes')->count()
            ]
        ];
        
        $medical_case = [
            'total' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'medical'])->count(),
            'unvaccinated' => [
                'rat_+' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'medical', 'details->vaccinated' => null, ])->where('details->ra_test', 'yes')->count(),
                'rat_-' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'medical', 'details->vaccinated' => null, ])->where('details->ra_test', '<>', 'yes')->count(),
                'ratpcr_+' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'medical', 'details->vaccinated' => null, ])->where('details->rtpcr_test', 'yes')->count(),
                'ratpcr_-' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'medical', 'details->vaccinated' => null, ])->where('details->rtpcr_test', '<>', 'yes')->count()
            ],
            'first_dose' => [
                'rat_+' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'medical', 'details->vaccinated' => 'first_vaccine', ])->where('details->ra_test', 'yes')->count(),
                'rat_-' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'medical', 'details->vaccinated' => 'first_vaccine', ])->where('details->ra_test', '<>', 'yes')->count(),
                'ratpcr_+' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'medical', 'details->vaccinated' => 'first_vaccine', ])->where('details->rtpcr_test', 'yes')->count(),
                'ratpcr_-' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'medical', 'details->vaccinated' => 'first_vaccine', ])->where('details->rtpcr_test', '<>', 'yes')->count()
            ],
            'second_dose' => [
                'rat_+' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'medical', 'details->vaccinated' => 'second_vaccine', ])->where('details->ra_test', 'yes')->count(),
                'rat_-' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'medical', 'details->vaccinated' => 'second_vaccine', ])->where('details->ra_test', '<>', 'yes')->count(),
                'ratpcr_+' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'medical', 'details->vaccinated' => 'second_vaccine', ])->where('details->rtpcr_test', 'yes')->count(),
                'ratpcr_-' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'medical', 'details->vaccinated' => 'second_vaccine', ])->where('details->rtpcr_test', '<>', 'yes')->count()
            ]
        ];

        $ob_case = [
            'total' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'ob'])->count(),
            'unvaccinated' => [
                'rat_+' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'ob', 'details->vaccinated' => null, ])->where('details->ra_test', 'yes')->count(),
                'rat_-' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'ob', 'details->vaccinated' => null, ])->where('details->ra_test', '<>', 'yes')->count(),
                'ratpcr_+' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'ob', 'details->vaccinated' => null, ])->where('details->rtpcr_test', 'yes')->count(),
                'ratpcr_-' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'ob', 'details->vaccinated' => null, ])->where('details->rtpcr_test', '<>', 'yes')->count()
            ],
            'first_dose' => [
                'rat_+' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'ob', 'details->vaccinated' => 'first_vaccine', ])->where('details->ra_test', 'yes')->count(),
                'rat_-' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'ob', 'details->vaccinated' => 'first_vaccine', ])->where('details->ra_test', '<>', 'yes')->count(),
                'ratpcr_+' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'ob', 'details->vaccinated' => 'first_vaccine', ])->where('details->rtpcr_test', 'yes')->count(),
                'ratpcr_-' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'ob', 'details->vaccinated' => 'first_vaccine', ])->where('details->rtpcr_test', '<>', 'yes')->count()
            ],
            'second_dose' => [
                'rat_+' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'ob', 'details->vaccinated' => 'second_vaccine', ])->where('details->ra_test', 'yes')->count(),
                'rat_-' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'ob', 'details->vaccinated' => 'second_vaccine', ])->where('details->ra_test', '<>', 'yes')->count(),
                'ratpcr_+' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'ob', 'details->vaccinated' => 'second_vaccine', ])->where('details->rtpcr_test', 'yes')->count(),
                'ratpcr_-' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'ob', 'details->vaccinated' => 'second_vaccine', ])->where('details->rtpcr_test', '<>', 'yes')->count()
            ]
        ];

        $pedia_case = [
            'total' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'pedia'])->count(),
            'unvaccinated' => [
                'rat_+' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'pedia', 'details->vaccinated' => null, ])->where('details->ra_test', 'yes')->count(),
                'rat_-' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'pedia', 'details->vaccinated' => null, ])->where('details->ra_test', '<>', 'yes')->count(),
                'ratpcr_+' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'pedia', 'details->vaccinated' => null, ])->where('details->rtpcr_test', 'yes')->count(),
                'ratpcr_-' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'pedia', 'details->vaccinated' => null, ])->where('details->rtpcr_test', '<>', 'yes')->count()
            ],
            'first_dose' => [
                'rat_+' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'pedia', 'details->vaccinated' => 'first_vaccine', ])->where('details->ra_test', 'yes')->count(),
                'rat_-' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'pedia', 'details->vaccinated' => 'first_vaccine', ])->where('details->ra_test', '<>', 'yes')->count(),
                'ratpcr_+' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'pedia', 'details->vaccinated' => 'first_vaccine', ])->where('details->rtpcr_test', 'yes')->count(),
                'ratpcr_-' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'pedia', 'details->vaccinated' => 'first_vaccine', ])->where('details->rtpcr_test', '<>', 'yes')->count()
            ],
            'second_dose' => [
                'rat_+' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'pedia', 'details->vaccinated' => 'second_vaccine', ])->where('details->ra_test', 'yes')->count(),
                'rat_-' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'pedia', 'details->vaccinated' => 'second_vaccine', ])->where('details->ra_test', '<>', 'yes')->count(),
                'ratpcr_+' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'pedia', 'details->vaccinated' => 'second_vaccine', ])->where('details->rtpcr_test', 'yes')->count(),
                'ratpcr_-' => Patient::whereYear('referred_at', '=', $year)->whereMonth('referred_at', '=', $month)->where(['case' => 'pedia', 'details->vaccinated' => 'second_vaccine', ])->where('details->rtpcr_test', '<>', 'yes')->count()
            ]
        ];

        return [
            'total' => $total,
            'calls' => $calls,
            'trauma_case' => $trauma_case,
            'medical_case' => $medical_case,
            'ob_case' => $ob_case,
            'pedia_case' => $pedia_case,
            'date' => $selected_date
        ];
    }
}
