<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\{Request, JsonResponse};
use Illuminate\Support\Facades\{Auth, Hash};
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
	/**
	 * Handle an incoming registration request.
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function store(Request $request): JsonResponse
	{
		try {
			$request->validate([
				'name' => ['required', 'string', 'max:255', 'unique:' . User::class],
				'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:' . User::class],
				'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()->mixedCase()],
			]);

			$user = User::create([
				'name' => $request->name,
				'email' => $request->email,
				'password' => Hash::make($request->password),
			]);

			event(new Registered($user));

			Auth::login($user);

			return response()->json($request);
		} catch (\Throwable $th) {
			return response()->json([
				"success" => false,
				"message" => $th->getMessage()
			]);
		}
	}
}
