<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Appointment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller {
    public function createStripeSession(Request $request) {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = Auth::user();

        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'time' => 'required',
            'price' => 'required|numeric'
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Doctor Appointment',
                    ],
                    'unit_amount' => $request->price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/api/stripe/success?session_id={CHECKOUT_SESSION_ID}'),
            'cancel_url' => url('/api/stripe/cancel'),
            'metadata' => [
                'user_id' => $user->id,
                'doctor_id' => $request->doctor_id,
                'date' => $request->date,
                'time' => $request->time,
            ]
        ]);

        return response()->json(['url' => $session->url]);
    }





    public function handleWebhook(Request $request) {
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $secret = config('services.stripe.webhook_secret'); // حطها في env

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $secret
            );
        } catch (\Exception $e) {
            Log::error('Stripe Webhook Error: ' . $e->getMessage());
            return response('Invalid signature', 400);
        }

        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;

            // إنشاء موعد جديد
            Appointment::create([
                'user_id' => $session->metadata->user_id,
                'doctor_id' => $session->metadata->doctor_id,
                'date' => $session->metadata->date,
                'time' => $session->metadata->time,
                'status' => 'confirmed',
                'is_paid' => true,
                'payment_reference' => $session->id,
            ]);
        }

        return response('Webhook handled', 200);
    }
}
