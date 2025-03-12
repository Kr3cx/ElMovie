<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profil;

class ProfileController extends Controller
{

    public function edit()
    {
        $user = Auth::user();
        $profil = $user->profil ?? new Profil(); 
        return view('profile.edit', compact('user', 'profil'));
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'umur' => 'nullable|integer|min:0',
            'bio' => 'nullable|string',
            'alamat' => 'nullable|string|max:255',
        ]);
    
        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
    
        $user->profil()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'umur' => $request->umur,
                'bio' => $request->bio ?? '',
                'alamat' => $request->alamat ?? 'Alamat tidak tersedia', // Berikan nilai default
            ]
        );
        
    
        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }
    
}
