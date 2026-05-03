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
        // Load settings to keep Navbar and Footer dynamic
        $settings = Setting::pluck('value', 'key')->toArray();
        
        // 🌟 PROFESSIONAL UPDATE: Homepage Pagination & No Status Limit
        $featured_cars = Car::with('category')->latest()->paginate(3);
        
        return view('frontend.index', compact('settings', 'featured_cars'));
    }

    // 🌟 THE ELITE SEARCH ENGINE 🌟
    public function fleet(Request $request)
    {
        // Load settings
        $settings = Setting::pluck('value', 'key')->toArray();

        $query = Car::with('category');

        // 🧠 LOGIC 1: Filter by City/Location
        if ($request->filled('location') && $request->location !== 'Global Coverage') {
            $query->where('city', $request->location);
        }

        // 🧠 LOGIC 2: Filter by Vehicle Class (Category)
        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->category . '%'); 
            });
        }

        // 🧠 LOGIC 3: Filter by Selected Brand (New Search Logic)
        if ($request->filled('search')) {
            $query->where('brand', $request->search);
        }

        // 🧠 LOGIC 4: Filter by Maximum Budget (New Price Logic)
        if ($request->filled('max_price')) {
            $query->where('daily_rent', '<=', $request->max_price);
        }

        // 🚀 LOGIC 5: ACCESSIBILITY FEATURE (Wheelchair Filter)
        if ($request->filled('wheelchair_accessible')) {
            $query->where('is_wheelchair_accessible', 1);
        }

        // Get results and paginate
        $cars = $query->latest()->paginate(9);

        return view('frontend.fleet', compact('settings', 'cars'));
    }

    // Show complete details of a single car
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
    
    public function services()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('frontend.services', compact('settings'));
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

    /**
     * 🤖 CUSTOM AI CHATBOT LOGIC
     */
    public function chatbotReply(Request $request)
    {
        $userMessage = strtolower($request->message);
        $botResponses = \App\Models\BotResponse::all();
        
        // Default answer if bot does not understand
        $reply = "I am sorry, I did not understand that. Please mail at driveelie099@gmail.com";

        // Search for keyword in user message
        foreach ($botResponses as $bot) {
            if (str_contains($userMessage, strtolower($bot->keyword))) {
                $reply = $bot->response;
                break; // Stop searching once we find a match
            }
        }

        return response()->json(['reply' => $reply]);
    }
}