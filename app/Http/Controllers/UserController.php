<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Closure;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->get();

        return view('user.index', [
            'data' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return view('user.create', [
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,except,id',
            'password' => 'nullable',
            'roles' => 'required',
        ]);

        if(!$request->password) {
            $validatedData['password'] = bcrypt('password');
        }

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);
        $user->assignRole($request->roles);

        return redirect()->route('user.index')->with('success', 'User created successfully.');
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
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('user.edit', [
            'data' => $user,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'roles' => 'required',
        ]);

        if($request->password) {
            $validatedData['password'] = bcrypt($request->password);
        }

        $user->update($validatedData);
        $user->syncRoles($request->roles);

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        $request->session()->flash('success', 'Data berhasil dihapus.');
        return response()->json('Data berhasil dihapus', 200);
        // return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
