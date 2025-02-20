<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
  public function create(): View
  {
    return view('auth.login');
  }

  public function store(LoginRequest $request): RedirectResponse
  {
    $request->validate([
      'login' => ['required', 'string'],
      'password' => ['required', 'string'],
    ]);

    $login = $request->login;

    if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
      $user = User::where('email', $login)->first();
    } else {
      $cleanRut = preg_replace('/[^0-9kK]/', '', $login);
      $formattedRut = substr($cleanRut, 0, -1) . '-' . strtoupper(substr($cleanRut, -1));

      $user = User::where('rut', $formattedRut)->first();
    }

    if ($user && Hash::check($request->password, $user->password)) {
      Auth::login($user, $request->remember);
      $request->session()->regenerate();

      return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
      'login' => 'Las credenciales proporcionadas no coinciden con nuestros registros.'
    ]);
  }

  public function destroy(Request $request): RedirectResponse
  {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }
}
