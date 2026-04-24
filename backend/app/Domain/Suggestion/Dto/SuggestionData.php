<?php

namespace App\Domain\Suggestion\Dto;


class SuggestionData
{
    public function __construct(
        readonly int $bookId,
        readonly int $communityId
    ) {}

    public static function from(array $inputs): self
    {
        return new self(
            $inputs['book_id'],
            $inputs['community_id']
        );
    }
}
