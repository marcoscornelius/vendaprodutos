<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id); 
        return view('clients.edit', compact('client')); 
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:55',
            'email' => 'required|string|email|max:75|unique:clients,email,' . $id,
            'phone' => 'nullable|string|max:15', 
        ]);

        $client = Client::findOrFail($id); 
        $client->update($request->all()); 
        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:55',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'nullable|string|max:15',
        ]);

        Client::create($request->only('name', 'email', 'phone'));

        return redirect()->route('clients.index')->with('success', 'Client added successfully.');
    }
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
       
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}