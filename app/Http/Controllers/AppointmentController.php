<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Customer;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('customer')
            ->orderBy('date')
            ->orderBy('time')
            ->paginate(15);

        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $customers = Customer::orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        $reasons = Appointment::reasons();
        $statuses = Appointment::statuses();
        $companies = Appointment::insuranceCompanies();

        return view('appointments.create', compact(
            'customers',
            'reasons',
            'statuses',
            'companies'
        ));
    }

    public function store(Request $request)
    {
        $reasons = Appointment::reasons();
        $statuses = Appointment::statuses();
        $companies = Appointment::insuranceCompanies();

        $validated = $request->validate([
            'customer_id'        => ['required', 'exists:customers,id'],
            'reason'             => ['required', 'in:' . implode(',', $reasons)],
            'reason_detail'      => ['nullable', 'string'],
            'date'               => ['required', 'date'],
            'time'               => ['required', 'date_format:H:i'],
            'location'           => ['nullable', 'string', 'max:255'],
            'status'             => ['required', 'in:' . implode(',', $statuses)],
            'insurance_company'  => ['nullable', 'in:' . implode(',', $companies)],
        ]);

        Appointment::create($validated);

        return redirect()
            ->route('appointments.index')
            ->with('success', 'Το ραντεβού καταχωρήθηκε με επιτυχία.');
    }

    public function show(Appointment $appointment)
    {
        $appointment->load('customer');

        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $customers = Customer::orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        $reasons = Appointment::reasons();
        $statuses = Appointment::statuses();
        $companies = Appointment::insuranceCompanies();

        return view('appointments.edit', compact(
            'appointment',
            'customers',
            'reasons',
            'statuses',
            'companies'
        ));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $reasons = Appointment::reasons();
        $statuses = Appointment::statuses();
        $companies = Appointment::insuranceCompanies();

        $validated = $request->validate([
            'customer_id'        => ['required', 'exists:customers,id'],
            'reason'             => ['required', 'in:' . implode(',', $reasons)],
            'reason_detail'      => ['nullable', 'string'],
            'date'               => ['required', 'date'],
            'time'               => ['required', 'date_format:H:i'],
            'location'           => ['nullable', 'string', 'max:255'],
            'status'             => ['required', 'in:' . implode(',', $statuses)],
            'insurance_company'  => ['nullable', 'in:' . implode(',', $companies)],
        ]);

        $appointment->update($validated);

        return redirect()
            ->route('appointments.index')
            ->with('success', 'Το ραντεβού ενημερώθηκε.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()
            ->route('appointments.index')
            ->with('success', 'Το ραντεβού διαγράφηκε.');
    }
}
