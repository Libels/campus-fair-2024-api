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
				'fullName' => ['required', 'string'],
				'email' => ['required', 'email:rfc,dns'],
				'phoneNumber' => ['required', 'string'],
				'company' => ['string', 'nullable'],
				'message' => ['required', 'string'],
			]);
		} catch (\Throwable $th) {
			return response()->json(['sucess' => false, 'message' => $th->getMessage()]);
		}

		try {
			$contact = ContactForm::create([
				'name' => $request->fullName,
				'email' => $request->email,
				'phone' => $request->phoneNumber,
				'company' => $request->company,
				'message' => $request->message
			]);

			return response()->json(['success' => true, 'message' => $contact->id]);
		} catch (\Throwable $th) {
			return response()->json(['success' => false, 'message' => $th->getMessage()]);
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
