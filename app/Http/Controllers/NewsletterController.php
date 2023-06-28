<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\{Request, JsonResponse};

class NewsletterController extends Controller
{
	/**
	 * Subscribe to LCF Mailing List.
	 */
	public function store(Request $request): JsonResponse
	{
		try {
			$validated = $request->validate([
				'email' => 'required|email:rfc,dns',
			]);
		} catch (\Throwable $th) {
			return response()->json(['sucess' => false, 'message' => $th->getMessage()]);
		}

		try {
			$subscriber = Newsletter::updateOrCreate([
				'email' => $request->email
			]);

			return response()->json(['success' => true, 'message' => $subscriber->id]);
		} catch (\Throwable $th) {
			$subscriber = Newsletter::where([
				'email' => $request->email
			])->restore();

			return response()->json(['success' => $subscriber ? true : false, 'message' => $subscriber ? 'resubscribed' : 'resubscription went wrong']);
		}
	}

	/**
	 * Unsubscribe to LCF Mailing List.
	 */
	public function destroy(Request $request): JsonResponse
	{
		try {
			$validated = $request->validate([
				'email' => 'required|email:rfc,dns',
			]);

			$subscriber = Newsletter::where([
				'email' => $request->email
			])->delete();

			return response()->json(['success' => $subscriber ? true : false, 'message' => $subscriber ? 'unsubscribed' : 'mail not in list']);
		} catch (\Throwable $th) {
			return response()->json(['sucess' => false, 'message' => $th->getMessage()]);
		}
	}
}
