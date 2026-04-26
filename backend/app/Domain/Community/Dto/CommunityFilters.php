<?php

namespace App\Domain\Community\Dto;

class CommunityFilters
{
    private function __construct(
        readonly string $search,
    ) {}

    public static function from(array $inputs)
    {
        return new self(
            search: $inputs['search'] ?? ''
        );
    }
}
