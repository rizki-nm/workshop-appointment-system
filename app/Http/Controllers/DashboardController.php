<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Drug;
use App\Models\Patient;
use App\Models\Poli;
use Illuminate\Http\Request;
use App\Models\RegistrationPoli;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'verified']);
    }
    public function index()
    {
        if (Auth::user()->role == 'doctor') {
            $pasien_today = RegistrationPoli::whereDate('created_at', date('Y-m-d'))->count();
            $pasien_waiting = RegistrationPoli::whereDate('created_at', date('Y-m-d'))->where('status', 'waiting')->count();
            $pasien_called = RegistrationPoli::whereDate('created_at', date('Y-m-d'))->where('status', 'called')->count();
            $pasien_canceled = RegistrationPoli::whereDate('created_at', date('Y-m-d'))->where('status', 'canceled')->count();
            $pasien_done = RegistrationPoli::whereDate('created_at', date('Y-m-d'))->where('status', 'done')->count();
            return view('dashboard.index', compact('pasien_today', 'pasien_waiting', 'pasien_called', 'pasien_canceled', 'pasien_done'));
        } elseif (Auth::user()->role == 'admin') {
            $total_dokter = Doctor::all()->count();
            $total_pasien = Patient::all()->count();
            $total_poli = Poli::all()->count();
            $total_obat = Drug::all()->count();
            return view('dashboard.index', compact('total_dokter', 'total_pasien', 'total_obat', 'total_poli'));
        } else {
            $total_antrian_waiting = RegistrationPoli::where('patient_id', auth()->user()->patient->id)->where('status', 'waiting')->count();
            $total_antrian_done = RegistrationPoli::where('patient_id', auth()->user()->patient->id)->where('status', 'done')->count();
            return view('dashboard.index', compact('total_antrian_waiting', 'total_antrian_done'));
        }
    }
}
