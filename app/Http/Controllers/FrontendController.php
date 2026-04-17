<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Newsletter; // 🚀 Newsletter Model Import kiya

class FrontendController extends Controller
{
    public function index()
    {
        // Settings load kar rahay hain taake Navbar aur Footer dynamic rahay
        $settings = Setting::pluck('value', 'key')->toArray();
        
        // 🌟 PROFESSIONAL UPDATE: Homepage Pagination & No Status Limit
        $featured_cars = Car::with('category')->latest()->paginate(3);
        
        return view('frontend.index', compact('settings', 'featured_cars'));
    }

    // 🌟 THE ELITE SEARCH ENGINE 🌟
    public function fleet(Request $request)
    {
        // Settings load karein
        $settings = Setting::pluck('value', 'key')->toArray();

        $query = Car::with('category');

        // 🧠 LOGIC 1: Agar City select ki hai
        if ($request->filled('location') && $request->location !== 'Global Coverage') {
            $query->where('city', $request->location);
        }

        // 🧠 LOGIC 2: Agar Vehicle Class (Category) select ki hai
        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->category . '%'); 
            });
        }

        // Results nikalo aur paginate kar do
        $cars = $query->latest()->paginate(9);

        return view('frontend.fleet', compact('settings', 'cars'));
    }

    // Gari ki mukammal detail dikhane ke liye
    public function showCar(Car $car)
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('frontend.car_details', compact('settings', 'car'));
    }

    /**
     * 🌟 THE ELITE ABOUT PAGE
     */
    public function about()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('frontend.about', compact('settings'));
    }

    /**
     * 🚀 NEWSLETTER SUBSCRIPTION LOGIC (Step 2)
     */
    public function subscribe(Request $request)
{
    $request->validate([
        'email' => 'required|email|unique:newsletters,email',
    ], [
        // ✅ English Messages (Professional Standard)
        'email.unique' => 'You are already subscribed to our newsletter.',
        'email.email' => 'Please enter a valid email address.'
    ]);

    Newsletter::create([
        'email' => $request->email
    ]);

    // ✅ Professional Success Message
    return back()->with('success', 'Thank you! You have successfully subscribed to our newsletter.');
}
}