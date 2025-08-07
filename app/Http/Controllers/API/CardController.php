<?php

namespace App\Http\Controllers\Api;

use Exception;
use Stripe\Stripe;
use App\Models\Card;
use Stripe\Customer;
use Stripe\PaymentMethod;
use App\Traits\API\apiTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller {
    use apiTrait;
    private $user;
    public function __construct() {
        $this->user = \App\Models\User::find(Auth::id());
        Stripe::setApiKey(config('services.stripe.secret'));
    }
    public function index() {
        $cards = $this->user->cards()->get();
        return $this->successResponse($cards, 'User cards retrieved successfully', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'card_token' => 'required|string',
            'holder_name' => 'required|string',
        ]);
        try {
            if (!$this->user->stripe_id) {
                $customer = Customer::create([
                    'email' => $this->user->email,
                    'name' => $this->user->name,
                    'metadata' => ['user_id' => $this->user->id]
                ]);
                $this->user->stripe_id = $customer->id;
                $this->user->save();
            }
            $paymentMethod = PaymentMethod::create([
                'type' => 'card',
                'card' => [
                    'token' => $request->card_token
                ],
            ]);
            $paymentMethod->attach(['customer' => $this->user->stripe_id]);
            $card = Card::create([
                'user_id' => $this->user->id,
                'card_holder_name' => $request->holder_name,
                'stripe_pm_id' => $paymentMethod->id,
                'brand' => $paymentMethod->card->brand,
                'last_four' => $paymentMethod->card->last4,
                'exp_month' => $paymentMethod->card->exp_month,
                'exp_year' => $paymentMethod->card->exp_year,
            ]);
            return $this->successResponse($card, 'Card added successfully', 201);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 'Failed to add card', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $card = $this->user->cards()->find($id);
        if (!$card) {
            return $this->errorResponse('Card not found', 'Not Found', 404);
        }
        return $this->successResponse($card, 'Card retrieved successfully', 200);
    }


    public function update(Request $request, string $id) {
        try {
            $request->validate([
                'card_token' => 'required|string',
                'holder_name' => 'required|string',
            ]);
            $card = $this->user->cards()->find($id);
            if (!$card) {
                return $this->errorResponse('Card not found', 'Not Found', 404);
            }
            $oldPaymentMethod = PaymentMethod::retrieve($card->stripe_pm_id);
            $oldPaymentMethod->detach();
            $newPaymentMethod = PaymentMethod::create([
                'type' => 'card',
                'card' => [
                    'token' => $request->card_token
                ],
            ]);
            $newPaymentMethod->attach(['customer' => $this->user->stripe_id]);
            $card->card_holder_name = $request->holder_name;
            $card->stripe_pm_id = $newPaymentMethod->id;
            $card->brand = $newPaymentMethod->card->brand;
            $card->last_four = $newPaymentMethod->card->last4;
            $card->exp_month = $newPaymentMethod->card->exp_month;
            $card->exp_year = $newPaymentMethod->card->exp_year;
            $card->save();
            return $this->successResponse($card, 'Card updated successfully', 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 'Failed to update card', 500);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        try {
            $card = $this->user->cards()->find($id);
            $paymentMethod = PaymentMethod::retrieve($card->stripe_pm_id);
            $paymentMethod->detach();
            $card->delete();
            return $this->successResponse([], 'Card deleted successfully', 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 'Failed to delete card', 500);
        }
    }
}
