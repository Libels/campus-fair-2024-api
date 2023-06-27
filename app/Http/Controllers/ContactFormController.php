<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use Illuminate\Http\{Request, JsonResponse};

class ContactFormController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		// $validated = $request->validated();
		$validated = $request->validate([
			'email' => 'required|email:rfc,dns',
		]);

		return response()->json($validated);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(ContactForm $contactForm)
	{
		//
	}
}
