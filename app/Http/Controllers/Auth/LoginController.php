<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login');
    }

  
    /**
     * user login function...
     */
    public function login(Request $request)
    {
        // Validate the request input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        try {
            // Attempt to authenticate the user
            if (Auth::attempt($credentials)) {
                // Regenerate the session
                $request->session()->regenerate();
    
                // Redirect to the intended page
                return redirect()->intended('/');
            }
    
            // If authentication fails
            return back()->with('error', 'Invalid credentials');
        } catch (Exception $e) {
            // Log the exception details
            Log::error('Error during login: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'input' => $request->except('password') // Avoid logging sensitive data
            ]);
    
            // Redirect back with a generic error message
            return back()->with('error', 'An error occurred while trying to log in. Please try again later.');
        }
    }
}
