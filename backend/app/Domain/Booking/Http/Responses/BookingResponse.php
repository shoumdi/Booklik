<?php

namespace App\Domain\Booking\Http\Responses;

use Core\Ressource;

class BookingResponse extends Ressource
{
    protected function toArray(): array
    {
        return [
            'book_title' => $this->model->communityBook()->book()->title,
        ];
    }
}
