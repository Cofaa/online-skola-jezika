<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::query()
            ->with(['student', 'lessonSession.course', 'lessonSession.teacher'])
            ->latest()
            ->paginate(15);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function confirm(Booking $booking)
    {
        if ($booking->status !== 'pending') {
            return back()->with('error', 'Only pending bookings can be confirmed.');
        }

        $booking->update(['status' => 'confirmed']);

        return back()->with('success', 'Booking confirmed successfully.');
    }

    public function cancel(Booking $booking)
    {
        if ($booking->status === 'cancelled') {
            return back()->with('error', 'Booking is already cancelled.');
        }

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Booking cancelled successfully.');
    }
}
