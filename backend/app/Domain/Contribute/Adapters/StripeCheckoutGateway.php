<?php

namespace App\Domain\Contribute\Adapters;

use App\Domain\Contribute\Interfaces\CheckoutGateway;
use App\Domain\Contribute\Interfaces\Payable;
use App\Domain\Contribute\Interfaces\PaymentGateway;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\StripeClient;

class StripeCheckoutGateway implements CheckoutGateway
{
    public function __construct(
        private StripeClient $client
    ) {}
    public function checkout(array $checkoutData)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        $session = $this->client->checkout->sessions->create(
            [
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'unit_amount' => $checkoutData['amount']
                        ],
                        'quantity' => 1
                    ]
                ],
                'mode' => 'payment',
                'success_url' => $checkoutData['success_url'],
                'cancel_url' => $checkoutData['cancel_url'],
                'metadata' => ['user_id' => $checkoutData['user_id'], 'community_id' => $checkoutData['community_id']]
            ]
        );
        return $session->url;
    }
}
