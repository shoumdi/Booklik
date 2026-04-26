<?php

namespace App\Domain\Contribute\Http\Controllers;

use App\Domain\Community\Models\Community;
use App\Domain\User\Services\CalculatePoints;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Webhook;

class ContributionWebhookController extends Controller
{
    public function __invoke(
        Request $request
    ) {
        try {
            $payload = $request->getContent();
            $signatur = $request->header('Stripe-Signature');
            $secret = config('services.stripe.webhook_secret');
            $event = Webhook::constructEvent($payload, $signatur, $secret);
            $amount = $event->data->object->amount_total/100;
            switch ($event->type) {
                case 'checkout.session.completed':
                    $metadata = $event->data->object->metadata;
                    
                    $community = Community::findOrFail($metadata['community_id']);
                    $community->contributions()
                        ->create([
                            'amount' => $amount,
                            'made_by'=> $metadata['user_id']
                        ]);
                    $community->contribute($amount);
                    $point = $community->points()
                        ->where('user_id', $metadata['user_id'])
                        ->first();
                    $point->add(CalculatePoints::contributionPoints(200));
                    break;
            }
        } catch (SignatureVerificationException $e) {
            Log::error('failed to webhook', ['error' => $e->getMessage()]);
            return response('Invalide signature', 400);
        }
        return response()->json(['ok' => true], 200);
    }
}
