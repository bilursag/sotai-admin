<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index() 
  {
    $users = User::all();
    return view('admin.users.index', compact('users'));
  }

  public function create()
  {
    $roles = Role::all();
    return view('admin.users.create', compact('roles'));
  }

  public function debug()
{
    try {
      return \Spatie\Permission\Models\Role::all();
    } catch (\Exception $e) {
      return $e->getMessage();
    }
}

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'rut' => 'required|string|max:255|unique:users',
      'password'=> 'required|string|min:8|confirmed',
      'roles' => 'required|array',
    ]);

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'rut' => $request->rut,
      'password' => bcrypt($request->password),
    ]);

    $user->syncRoles($request->roles);

    return redirect()->route('admin.users.index')->with('success', 'Usuario creado correctamente.');
  }

  public function show(string $id)
  {}

  public function edit(User $user)
  {
    $roles = Role::all();
    return view('admin.users.edit', compact('user', 'roles'));
  }

  public function update(Request $request, User $user)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users, email,' . $user->id,
      'rut' => 'required|string|max:255|unique:users, rut,' . $user->id,
      'roles' => 'required|array',
    ]);

    $user->update([
      'name' => $request->name,
      'email' => $request->email,
      'rut' => $request->rutm,
    ]);

    $user->syncRoles($request->roles);
    
    return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado correctamente.');

  }

  public function destroy(User $user)
  {
    $user->delete();

    return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado correctamente.');
  }
}
