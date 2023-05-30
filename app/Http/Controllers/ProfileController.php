<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Validation\Rules;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('pages.profile', [
            'item' => Auth::user()
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:100'],
        ]);

        if ($request->nip !== Auth::user()->nip) {
            $request->validate([
                'nip' => ['required', 'string', 'max:50', 'unique:users'],
            ]);
        }

        if ($request->email !== Auth::user()->email) {
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            ]);
        }

        if ($request->password) {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
        }

        if ($request->avatar) {
            $request->validate([
                'avatar' => ['image', 'mimes:png,jpg,jpeg'],
            ]);

            $extension = $request->file('avatar')->extension();
            $imageNames = uniqid('img_', microtime()) . '.' . $extension;
            $request->file('avatar')->move(public_path('avatar'), $imageNames);
        }

        $item = User::where('id', Auth::user()->id)->first();

        $item->nama = $request->nama;
        $item->nip = $request->nip;
        $item->email = $request->email;
        if ($request->password) {
            $item->password = Hash::make($request->password);
        }
        if ($request->avatar) {
            $item->avatar = $imageNames;
        }
        $item->save();

        Alert::toast('Berhasil Update Profile', 'success')->position('top');
        return redirect()->route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
