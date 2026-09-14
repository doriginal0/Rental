<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show the login form
    public function RedirectTo() 
    {
        /** @var \App\Models\Client|null $user */
        $user = Auth::user();
    if ($user->isAdmin())  {return route('clients.index');}

    return route('dashboard');
    
        }




    public function ShowRegister() {
     if (Auth::check()){

        return redirect($this->RedirectTo());
     }
        return view('auth.register');

    }

    public function Register(Request $request) {
     $validated = $request->validate([
      'name' => 'required|string|max:100',
      'company_name' => 'required|string|max:100',
      'email' => 'required|email|unique:clients,email',
      'password' => 'required|confirmed|min:8',
      'phone' => 'nullable|string|max:20',
     ]);

     $client = Client::create($validated);

     Auth::login($client);
     $request->session()->regenerate();

     return redirect($this->RedirectTo())
     ->with('success', 'Welcome! Your new account is ready' . $client->company_name);
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
        return redirect($this->RedirectTo());
    }
        return view('auth.login');
    }

    // Process the login attempt
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in using the 'web' guard (which now uses Client model)
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect($this->RedirectTo());
        }

        // Login failed
        return back()
            ->withErrors(['email' => 'The provided credentials do not match our records.'])
            ->onlyInput('email');
    }

    // Log the client out
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}