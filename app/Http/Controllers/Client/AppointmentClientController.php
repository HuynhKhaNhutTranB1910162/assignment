<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AppointmentClientController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/', 'max:255'],
            'status' => 'in:pending,cancel,success',
            'notes' => 'nullable',
        ]);
        if (Auth::check()) {
            Appointment::query()->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'status' => 'pending',
                'notes' => $data['notes'],

            ]);

            toastr()->success('Đã đặt tư vấn thành thành công');

            return redirect()->back();
        }
        toastr()->warning('vui lòng đăng nhập khi đặt tư vấn');

        return redirect()->back();
    }
}
