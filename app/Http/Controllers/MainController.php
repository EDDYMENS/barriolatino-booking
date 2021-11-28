<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Description;
use App\Slot;
use App\Booking;

class MainController extends Controller
{
    public function bookings(Request $request, $name = null)
    {
        $isAdmin = ($name == 'chiara');
        $description = Description::first();
        $dateComponents = getdate();
        $month = $dateComponents['mon'];
        $year = $dateComponents['year'];
        $slots = Slot::whereYear('date', $year)->whereMonth('date', $month)->get();
        $calData = [
            'availableSlots' => sortSlots($slots)
        ];
        $calendar = build_calendar($month,$year, $calData);
        $currentDate = $year.'-'.$month;
        return view('index', compact('calendar', 'calData', 'isAdmin', 'description', 'currentDate'));
    }

    public function newBooking(Request $request)
    {
        try {
            $booking = new Booking([
                'name' => $request->name,
                'email' => $request->email,
                'number' => $request->number,
                'time' => $request->option,
                'note' => $request->note,
                'date' => $request->date.'-'.$request->day,
            ]);
            $booking->save();
            $status = 'success';
        } catch(\Exception $e) {
            // dd($e);
            $status = 'failed';
        }
        return redirect()->route('home')->with(compact('status'));
    }

    public function updateDescription(Request $request)
    {
        try {
            if($description = Description::first()) {
                $description->description = $request->description;
            } else {
               $description =  new Description(['description' => $request->description]);
            }
            $description->save();
        } catch(\Exception $e) {
           dd($e);
        }
        return redirect('/');
    }

}
