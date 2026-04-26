<?php

namespace App\Domain\Contribute\Http\Controllers;

use App\Domain\Contribute\Http\Requests\MakeContributionRequest;
use App\Domain\Contribute\Interfaces\CheckoutGateway;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;
use Illuminate\Support\Facades\Auth;

class CheckoutContributionController extends Controller
{
    public function __construct(
        private CheckoutGateway $gatway
    ) {}
    public function __invoke(MakeContributionRequest $req, int $communityId)
    {
        $url = $this->gatway->checkout([
            'user_id' => Auth::guard()->id(),
            'community_id' => $communityId,
            $req->validated()
        ]);
        return SuccessJsonResponse::make(['redirect_to' => $url], 200);
    }
}
