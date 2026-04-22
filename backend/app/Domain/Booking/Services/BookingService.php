<?php

namespace App\Domain\Booking\Services;

use App\Domain\Book\Models\Book;
use App\Domain\Booking\Dto\BookingData;
use App\Domain\Booking\Models\Booking;
use App\Domain\Community\Models\Community;
use App\Domain\Community\Models\CommunityBook;
use App\Domain\User\Models\Point;
use App\Domain\User\Services\CalculatePoints;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingService
{
    /**
     * Create a new class instance.
     */

    public function execute(BookingData $data)
    {
        return DB::transaction(function () use ($data) {
            $book = CommunityBook::findOrFail(['id' => $data->communityBookId, 'status' => 'AVAILABLE']);
            $created = $book->bookings()->create(['days_number' => $data->numberOfDays]);
            $point = Point::whereHas('users', fn($q) => $q->where('id', Auth::id()))
                ->whereHas('communities', fn($q) => $q->where('id', $data->communityId))->firstOrFail();
            $point->decrease(CalculatePoints::bookingPoints($data->numberOfDays));
            return $created;
        });
    }
}
