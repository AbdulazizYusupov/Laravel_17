<?php

namespace App\Livewire;

use App\Models\Jurnal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginComponent extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];
    public function logout()
    {
        $user = Auth::user();
        $date = now()->toDateString();

        $jurnal = Jurnal::where('user_id', $user->id)
            ->where('date', $date)
            ->first();
        if ($jurnal) {
            $end_time = now()->toTimeString();
            $start_time = $jurnal->start_time;

            $time_difference = round((strtotime($end_time) - strtotime($start_time)) / 3600, 2);

            $jurnal->update([
                'end_time' => $end_time,
                'time' => $time_difference,
            ]);
        }

        Auth::logout();
        session()->flash('success', 'Siz tizimdan muvaffaqiyatli chiqdingiz!');
        return redirect('/login');
    }
    public function render()
    {
        return view('livewire.login-component')->layout('components.layouts.sign');
    }
    public function check()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $user = Auth::user();
            $worker_id = $user->worker ? $user->worker->id : null;

            if (!$worker_id) {
                session()->flash('error', 'Hodim topilmadi!');
                return back();
            }

            $date = now()->toDateString();

            $existingJurnal = Jurnal::where('user_id', $user->id)
                ->where('date', $date)
                ->first();

            if ($existingJurnal) {
                session()->flash('success', 'Siz tizimga muvaffaqiyatli kirdingiz!');
                return redirect('/category');
            }

            $start_time = now()->toTimeString();

            Jurnal::create([
                'worker_id' => $worker_id,
                'user_id' => $user->id,
                'date' => $date,
                'start_time' => $start_time,
                'end_time' => null,
                'time' => 0,
            ]);

            session()->flash('success', 'Siz tizimga muvaffaqiyatli kirdingiz! Jurnal saqlandi.');
            return redirect('/category');
        } else {
            session()->flash('error', 'Foydalanuvchi topilmadi!');
            return back();
        }
    }
}
