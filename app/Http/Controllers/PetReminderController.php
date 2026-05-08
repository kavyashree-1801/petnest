<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PetReminder;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PetReminderController extends Controller
{

    // SHOW REMINDERS
    public function index()
    {

        // AUTO COMPLETE
        PetReminder::where('user_id', Auth::id())
            ->where('status', 'upcoming')
            ->whereDate('reminder_date', '<=', Carbon::today())
            ->update([
                'status' => 'completed'
            ]);


        // ALL REMINDERS
        $reminders = PetReminder::where('user_id', Auth::id())
                        ->latest()
                        ->get();


        // TODAY REMINDERS
        $todayReminders = PetReminder::where('user_id', Auth::id())
                            ->whereDate('reminder_date', Carbon::today())
                            ->count();


        // UPCOMING REMINDERS
        $upcomingReminders = PetReminder::where('user_id', Auth::id())
                                ->where('status', 'upcoming')
                                ->whereDate('reminder_date', '>', Carbon::today())
                                ->count();


        return view(
            'pet-reminders.index',
            compact(
                'reminders',
                'todayReminders',
                'upcomingReminders'
            )
        );
    }


    // STORE
    public function store(Request $request)
    {

        $request->validate([

            'category' => 'required',

            'pet_name' => 'required',

            'reminder_type' => 'required',

            'reminder_date' => 'required|date',

        ]);


        PetReminder::create([

            'user_id' => Auth::id(),

            'category' => $request->category,

            'pet_name' => $request->pet_name,

            'reminder_type' => $request->reminder_type,

            'reminder_date' => $request->reminder_date,

            'notes' => $request->notes,

            'status' => 'upcoming'

        ]);


        return back()->with(
            'success',
            'Reminder Added Successfully 🐾'
        );
    }


    // COMPLETE
    public function complete($id)
    {

        $reminder = PetReminder::findOrFail($id);

        $reminder->status = 'completed';

        $reminder->save();

        return back()->with(
            'success',
            'Reminder marked as completed ✅'
        );
    }

}