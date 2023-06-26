<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\{Request, JsonResponse};

class NewsletterController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		return response()->json(['status' => 'Hello']);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request): JsonResponse
	{
		// Validate the request...

		$subscriber = Newsletter::updateOrCreate([
			'email' => $request->email
		]);

		return response()->json(['status' => $subscriber->id]);
	}
}
