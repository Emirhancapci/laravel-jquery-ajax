<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IntroController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $client_lists = Client::all();

        return view('list', compact('client_lists'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $client = new Client();
        $client->first_name = $request->input('first_name');
        $client->last_name = $request->input('last_name');

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $fileName);
            $client->image = 'uploads/' . $fileName;
        }
        $client->save();

        return response()->json(['success' => 'Client saved successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);

        return response()->json($client);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $client = Client::findOrFail($id);
        $client->first_name = $request->input('first_name');
        $client->last_name = $request->input('last_name');

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $fileName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads'), $fileName);
            $client->image = 'uploads/' . $fileName;
        }

        $client->save();

        return response()->json([
            'success' => 'Client updated successfully',
            'client' => $client
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $client = Client::find($id);

        $client->delete();

        return response()->json(['success' => 'Client deleted successfully']);

    }
}
