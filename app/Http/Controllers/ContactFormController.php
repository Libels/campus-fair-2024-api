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
		try {
			$validated = $request->validate([
				'fullName' => 'required|string',
				'email' => 'required|email:rfc,dns',
				'phoneNumber' => 'required|string',
				'company' => 'string|nullable',
				'message' => 'required|string',
			]);

			return response()->json(["message" => $validated]);
		} catch (\Throwable $th) {
			return response()->json(['sucess' => false, 'message' => $th->getMessage()]);
		}
	}

	/**
	 * Display the specified resource.
	 */
	public function show(ContactForm $contactForm)
	{
		//
	}
}
