<?php

namespace App\Http\Controllers\Api;

use Exception;
use Stripe\Stripe;
use App\Models\Card;
use App\Traits\API\apiTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller {
    use apiTrait;
    private $user;

    public function __construct() {
        $this->user = Auth::user();
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

        $data = $request->validate([
            'card_number' => 'required|string',
            'holder_name' => 'required|string',
            'exp_month' => 'required|numeric|between:1,12',
            'exp_year' => 'required|numeric|min:' . date('y'),
            'cvc' => 'required|numeric|digits_between:3,4'
        ]);
        try {
            if (!$this->user->stripe_id) {
                $customer = \Stripe\Customer::create([
                    'email' => $this->user->email,
                    'name' => $this->user->name,
                    'metadata' => ['user_id' => $this->user->id]
                ]);
                $this->user->stripe_id = $customer->id;
                $this->user->save();
            }
            $paymentMethod = \Stripe\PaymentMethod::create([
                'type' => 'card',
                'card' => [
                    'number' => $data['card_number'],
                    'exp_month' => $data['exp_month'],
                    'exp_year' => $data['exp_year'],
                    'cvc' => $data['cvc'],
                ],
            ]);
            $paymentMethod->attach(['customer' => $this->user->stripe_id]);
            $card = Card::create([
                'user_id' => $this->user->id,
                'stripe_pm_id' => $paymentMethod->id,
                'brand' => $paymentMethod->card->brand,
                'last_four' => substr($request->card_number, -4),
                'exp_month' => $request->exp_month,
                'exp_year' => $request->exp_year,
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        try {
            $card = $this->user->cards()->find($id);
            $paymentMethod = \Stripe\PaymentMethod::retrieve($card->stripe_pm_id);
            $paymentMethod->detach();
            $card->delete();
            return $this->successResponse([], 'Card deleted successfully', 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 'Failed to delete card', 500);
        }
    }
}
