<?php

namespace App\Domain\Booking\Http\Controllers;

use App\Domain\Book\Http\Responses\BookResponse;
use App\Domain\Booking\Dto\BookingData;
use App\Domain\Booking\Http\Requests\BookingBookRequest;
use App\Domain\Booking\Services\BookingService;
use App\Shared\Http\Controllers\Controller;
use Core\SuccessJsonResponse;

class BookingBookController extends Controller
{
    public function __construct(
        private BookingService $service
    ) {}
    public function __invoke(
        BookingBookRequest $req,
        int $communityId,
        int $bookId
    ) {
        $inputs = array_merge($req->validated(), ['book_id' => $bookId, 'community_id' => $communityId]);
        $created = $this->service->execute(BookingData::from($inputs));
        return SuccessJsonResponse::make((new BookResponse($created))->build(), 201);
    }
}
