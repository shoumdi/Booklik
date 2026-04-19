<?php

namespace App\Domain\Contribute\Http\Controllers;

use App\Domain\Community\Models\Community;
use App\Domain\User\Services\CalculatePoints;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;
use Exception;
use Illuminate\Http\Request;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Webhook;

class ContributionWebhookController extends Controller
{
    public function __invoke(
        Request $request
    ) {
        $payload = $request->getContent();
        $signatur = $request->header('Stripe-Sgnature');
        $secret = config('services.stripe.webhook_secret');
        $event = Webhook::constructEvent($payload, $signatur, $secret);
        switch ($event->type) {
            case 'checkout.session.completed':
                $metadata = $event->data->object->metadata;
                $community = Community::findOrFail($metadata['community_id']);
                $community->contributions()
                    ->create([
                        'amount' => 200
                    ]);
                $point = $community->points()
                    ->where('user_id', $metadata['user_id'])
                    ->first();
                $point->add(CalculatePoints::contributionPoints(200));
                break;
        }
        return response()->json(['ok' => true], 200);
    }
}
