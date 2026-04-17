<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail; 
use App\Mail\BookingStatusMail; // 🌟 Hamari nayi Dynamic VIP Email Class

class BookingController extends Controller
{
    public function index()
    {
        // 🌟 'user' relationship load karna zaroori hai performance ke liye
        $bookings = Booking::with(['car', 'user'])->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate(['status' => 'required|string']);
        $oldStatus = $booking->status;
        
        $booking->update(['status' => $request->status]);

        // 🌟 VIP Dynamic Email Logic
        if ($oldStatus !== $request->status) {
            
            // Sirf tab email bhejni hai jab status Pending se in 3 mein se kisi aik par aaye
            if (in_array($request->status, ['Approved', 'Completed', 'Cancelled'])) {
                Mail::to($booking->user->email)->send(new BookingStatusMail($booking));
            }
        }

        return back()->with('success', 'Reservation status updated & Customer Notified!');
    }

    public function invoice(Booking $booking)
    {
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();

        // PDF ko data bheja
        $pdf = Pdf::loadView('admin.bookings.invoice', compact('booking', 'settings'));
        
        return $pdf->download('DriveElite-Invoice-00' . $booking->id . '.pdf');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return back()->with('success', 'Reservation deleted securely!');
    }

    public function payments()
    {
        // 🌟 Yahan bhi 'user' add kiya hai
        $bookings = Booking::where('status', 'Completed')->with(['car', 'user'])->latest()->get();
        $total_revenue = $bookings->sum('total_price');
        return view('admin.payments', compact('bookings', 'total_revenue'));
    }
}