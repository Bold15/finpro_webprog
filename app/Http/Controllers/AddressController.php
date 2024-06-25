<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::where('user_id', Auth::id())->get();
        return view('addresses.index', compact('addresses'));
    }

    public function create()
    {
        return view('addresses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'kota' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'nomor_hp' => 'required|string|max:15',
        ]);

        Address::create([
            'user_id' => Auth::id(),
            'alamat' => $request->alamat,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'kode_pos' => $request->kode_pos,
            'nomor_hp' => $request->nomor_hp,
        ]);

        return redirect()->route('addresses.index')->with('success', 'Address added successfully.');
    }
}
