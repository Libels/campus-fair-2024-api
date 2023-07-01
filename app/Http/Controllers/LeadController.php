<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
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
			$request->validate([
				'fullName' => ['required', 'string'],
				'email' => ['required', 'email:rfc,dns'],
				'phoneNumber' => ['required', 'string'],
				'role' => ['required', 'string'],
				'company' => ['required', 'string'],
				'message' => ['required', 'string'],
			]);
		} catch (\Throwable $th) {
			return response()->json(['sucess' => false, 'message' => $th->getMessage()]);
		}

		try {
			$contact = Lead::create([
				'name' => $request->fullName,
				'email' => $request->email,
				'phone' => $request->phoneNumber,
				'role' => $request->role,
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
	public function show(Lead $lead)
	{
		//
	}
}
