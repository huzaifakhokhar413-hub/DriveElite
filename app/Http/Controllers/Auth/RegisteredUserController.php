<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http; // 🌟 Added for reCAPTCHA API Call
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException; // 🌟 Added for custom errors
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 🌟 1. VIP Validations (Age, License, Terms, Captcha)
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:20'],
            'gender' => ['required', 'in:male,female,other'],
            
            // Age must be 18 or older
            'dob' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
            
            // Checkboxes must be checked (accepted)
            'driving_license' => ['required', 'accepted'],
            'terms' => ['required', 'accepted'],
            
            // reCAPTCHA response from frontend
            'g-recaptcha-response' => ['required'],
            
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            // 🌟 Custom Error Messages
            'dob.before_or_equal' => 'You are too young to register. You must be at least 18 years old.',
            'driving_license.accepted' => 'A valid driving license is required to join Drive Elite.',
            'terms.accepted' => 'You must agree to our Terms & Conditions to proceed.',
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
        ]);

        // 🌟 2. Google reCAPTCHA Backend Verification
        // Ye Google ke server par check karega ke user sach mein insaan hai ya bot
        $recaptchaResponse = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'), // .env file se secret key aayegi
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip()
        ]);

        if (!$recaptchaResponse->json('success')) {
            throw ValidationException::withMessages([
                'g-recaptcha-response' => 'Captcha verification failed. Please try again.'
            ]);
        }

        // 🌟 3. Secure Database Entry
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'has_driving_license' => true, // Agar validation pass hui, means yes
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // 🌟 4. VIP SweetAlert Welcome
        return redirect(route('dashboard', absolute: false))
            ->with('success', 'Account created successfully. Welcome to the Elite club.');
    }
}