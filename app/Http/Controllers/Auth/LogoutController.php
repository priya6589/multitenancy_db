<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Exception;


class LogoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function logout(Request $request)
    {
        try {
            // Log out the user
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login');
        } catch (Exception $e) {
            // Log the exception details
            Log::error('Error during logout: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return redirect('/login')->with('error', 'An error occurred while logging out. Please try again.');
        }
    }
}
