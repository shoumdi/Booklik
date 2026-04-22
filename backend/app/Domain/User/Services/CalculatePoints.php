<?php

namespace App\Domain\User\Services;

use App\Domain\Community\Models\Community;
use UnexpectedValueException;

class CalculatePoints
{
    public static function contributionPoints(
        float $amount
    ) {
        if ($amount <= 0) throw new UnexpectedValueException('contribution amount insufissiant');
        $floored = floor($amount / 10);
        if ($floored === 0) $floored + 1;
        return $floored;
    }

    /**
     * points given by a comunity for its members first join
     */
    public static function joinPoints(Community $community)
    {
        return (($count = $community->users()->count()) === 1)
            ? 50 : (($count === 2)
                ? 30 : (($count === 3)
                    ? 20 : 10
                )
            );
    }

    public static function bookingPoints(int $numberOfDays){
        return $numberOfDays * 3;
    }
}
