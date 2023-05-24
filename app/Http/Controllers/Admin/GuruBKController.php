<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use RealRashid\SweetAlert\Facades\Alert;

class GuruBKController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = User::where('role', 'BK')->orderBy('nama', 'ASC')->get();

        return view('pages.data-bk.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            Alert::toast('Perhatikan data yang diisi', 'error')->position('top');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create([
            'nama' => $request->nama,
            'role' => 'BK',
            'nip' => $request->nip,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Alert::toast('Berhasil Menambah Data Guru BK', 'success')->position('top');
        return redirect()->route('data-bk.index');
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
    public function edit(string $id)
    {
        $item = User::where('nip', $id)->first();

        return view('pages.data-bk.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            Alert::toast('Perhatikan data yang diisi', 'error');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $item = User::where('nip', $id)->first();

        if ($item->nip != $request->nip) {
            $validator4 = Validator::make($request->all(), [
                'nip' => 'required|string|max:20|unique:users',
            ]);

            if ($validator4->fails()) {
                Alert::toast('Perhatikan data yang diisi', 'error');
                return redirect()->back()->withErrors($validator4)->withInput();
            }
        }

        if ($item->email != $request->email) {
            $validator2 = Validator::make($request->all(), [
                'email' => 'required|string|max:50|email|unique:users',
            ]);

            if ($validator2->fails()) {
                Alert::toast('Perhatikan data yang diisi', 'error');
                return redirect()->back()->withErrors($validator2)->withInput();
            }
        }

        if ($request->password) {
            $validator3 = Validator::make($request->all(), [
                'password' => ['required', 'string', 'confirmed', Rules\Password::defaults() ]
            ]);

            if ($validator3->fails()) {
                Alert::toast('Perhatikan data yang diisi', 'error');
                return redirect()->back()->withErrors($validator3)->withInput();
            }
        }

        $item->nama = $request->nama;
        $item->nip = $request->nip;
        $item->email = $request->email;
        if ($request->password) {
            $item->password = Hash::make($request->password);
        }
        $item->save();

        Alert::toast('Berhasil Mengubah Data Guru BK', 'success')->position('top');
        return redirect()->route('data-bk.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = User::where('nip', $id)->first();

        $item->delete();

        Alert::toast('Berhasil Menghapus Data Guru BK', 'success')->position('top');
        return redirect()->route('data-bk.index');
    }
}
