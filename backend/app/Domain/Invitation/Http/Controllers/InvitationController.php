<?php

namespace App\Domain\Invitation\Http\Controllers;

use App\Domain\Community\Models\Community;
use App\Domain\Invitation\Http\Responses\InvitationResponse;
use App\Domain\Invitation\Models\Invitation;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;
use DomainException;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvitationController extends Controller
{
   public function store(int $communityId)
   {
      $created = DB::transaction(function () use ($communityId) {
         if (!auth()->user()->canSendInvit($communityId)) throw new DomainException('You already have an invitation');
         $invitation = Community::findOrFail($communityId)->invitations()->create();
         auth()->user()->invitations()->save($invitation);
         $invitation->refresh();
         return $invitation;
      });
      return SuccessJsonResponse::make((new InvitationResponse($created))->build(), 201);
   }

   public function accept(int $inviteId)
   {
      $saved = Invitation::findOrFail($inviteId)->accept();
      return SuccessJsonResponse::make((new InvitationResponse($saved))->build());
   }

   public function refuse(int $inviteId)
   {
      $saved = Invitation::findOrFail($inviteId)->refuse();
      return SuccessJsonResponse::make((new InvitationResponse($saved))->build());
   }
}
