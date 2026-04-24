<?php

namespace App\Domain\Booking\Dto;

class BookingData
{
    /**
     * Create a new class instance.
     */
    private function __construct(
        readonly int $communityBookId,
        readonly int $communityId,
        readonly int $numberOfDays
    ) {}

    public static function from(array $inputs)
    {
        return new self(
            $inputs['community_book_id'],
            $inputs['community_id'],
            $inputs['days_number']
        );
    }
}
