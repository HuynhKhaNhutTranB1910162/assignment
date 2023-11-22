<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppointmentAdminController extends Controller
{
    public int $itemPerPage = 5;

    public function index(): View
    {
        $appointments = Appointment::query()->orderByDesc('created_at')->paginate($this->itemPerPage);

        return view('admin.appointments.index', compact('appointments'));
    }
    public function edit(string $id): View
    {
        $appointment = Appointment::getAppointmentById($id);
        return view('admin.appointments.edit', compact('appointment'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $data = $request->validate([
            'status' => 'in:pending,success,cancel',
        ]);
        $appointment = Appointment::getAppointmentById($id);

        $appointment->update([
                'status' => $data['status'],
            ]);

        toastr()->success('Cập nhật trạng thái thành công');

        return redirect('appointments');
    }
}
