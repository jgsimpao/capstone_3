<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
	public function sendMessage(Request $request) {
		$validator = Validator::make($request->all(), [
			'first_name' => 'required|string|max:50',
			'last_name' => 'required|string|max:50',
			'phone' => 'required|string|min:7|max:50',
			'email' => 'required|string|email|max:50',
			'message' => 'required|string|min:10'
		]);

		if($validator->passes()) {
			$data = array(
				'first_name' => $request->input('first_name'),
				'last_name' => $request->input('last_name'),
				'phone' => $request->input('phone'),
				'email' => $request->input('email'),
				'content' => $request->input('message')
			);

			Mail::send('email', $data, function($message) use ($data) {
					$message->from($data['email'], $data['first_name'] . ' ' . $data['last_name']);
					$message->to('joel.simpao@outlook.com', 'Joel Simpao');
					$message->subject("Contact Us: Ka-Joel's B&B");
			});
		}
		else {
			return response()->json($validator->errors()->all(), 422);
		}
	}
}
