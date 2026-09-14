<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
class ClientController extends Controller
{
    public function index()

    {
    $clients = Client::withCount(['cars', 'bookings', 'customers'])->OrderBy('company_name')->paginate(10);

    return view('clients.index', compact('clients'));

    }

    public function destroy(Client $client) {

    if ($client->id === auth()->id())
        {return redirect()->route('clients.index')->with('error', "You can't delete your account");}

    $client->delete();

    return redirect()->route("clients.index")->with("success","Client deleted successfuly");
    }
}
