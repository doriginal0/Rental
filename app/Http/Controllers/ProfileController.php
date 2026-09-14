<?php

namespace App\Http\Controllers;
use App\Models\Client;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
    $client = auth()->user();
    return view("profile.index", compact("client"));

    }
    //
    public function update(Request $request)
    {
        $client = auth()->user();
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'company_name' => 'required|string|max:100',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|confirmed|min:8',
        ]);
        if (empty($validated['password'])) {
        unset($validated['password']);
        }
        $client->update($validated);
        return redirect()->route('profile.index')->with('success', 'Information updated successfully.');
    }
}
