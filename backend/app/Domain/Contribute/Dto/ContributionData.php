<?php

namespace App\Domain\Contribute\Dto;

class ContributionData
{
    /**
     * Create a new class instance.
     */
    private function __construct(
        readonly float $amount,
        readonly array $metadata,
        readonly array $urls
    ) {}

    public static function from(array $inputs): self
    {
        return new self(
            $inputs['amount'],
            ['community_id' => $inputs['community_id'], 'user_id' => $inputs['user_id']],
            ['success_url' => $inputs['success_url'], 'cancel_url' => $inputs['cancel_url']]
        );
    }
}
